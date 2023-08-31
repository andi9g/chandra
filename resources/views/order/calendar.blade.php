@extends('layouts.master')


@section("judul", "Calednar")
@section("warnacalendar", "active")
@section('style')
<style>
  
    #calendar {
      color:black;
      margin: 10px;
      font-size: 9pt;
    }

    #calendar .active{
      background: blue;
    }

    #calendar a {
        color: black;
    }
    #calendar .active {
        color: blue;
    }
    .fc-button-primary {
        background: rgb(26, 26, 114) !important;
    }
  
  </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-7">
                      <form action="{{ route('tambah.order', []) }}" method="get">
                          <button type="submit" class="btn btn-primary">
                              Tambah Data Order
                          </button>
                      </form>
                    </div>

                    <div class="col-md-5">
                      <form action="{{ url()->current() }}" method="get">
                        <input type="date" name="tanggal" value="{{ $keyword }}" id="" class="form-control" onchange="submit()">
                      </form>
                    </div>
                  </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="my-0 py-1">Data Order</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped">
                        <tr>
                            <th>Invoice</th>
                            <th>Name</th>
                            <th>To</th>
                            <th>Ket</th>
                        </tr>

                        @foreach ($data as $item)
                          <tr>
                            <td>{{ $item->invoice_number }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->accomodation." & ".$item->vessel }}</td>
                            <td>
                              @if (empty($item->confirmation))
                                  <button class="badge py-1 border-0 badge-warning" type="button" data-toggle="modal" data-target="#konfirmasi{{ $item->idinvoice }}">
                                    <i class="fa fa-exclamation-triangle"></i>
                                  </button>
                              @else
                                  <a href="{{ url('invoice/'.$item->invoice_number."/show", []) }}" target="_blank" class="badge badge-success">Detail</a>

                              @endif
                            </td>
                          </tr>
                          <div id="konfirmasi{{ $item->idinvoice }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="my-modal-title">KONFIRMASI</h5>
                                  <button class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="{{ route('konfirmation.invoice', [$item->idinvoice]) }}" method="post">
                                  @csrf
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="konfirmation">Hotel Konfirmation</label>
                                      <input id="konfirmation" class="form-control" type="text" name="confirmation">
                                    </div>
  
                                    <div class="form-group">
                                      <label for="konfirmation">Vessel Tiket</label>
                                      <input id="konfirmation" class="form-control" type="text" name="tiket">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">KONFIRM NOW</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div id='calendar'></div>

            </div>

        </div>

        
    </div>
</div>
@endsection



@section('script')
<script>

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      initialDate: "{{ $keyword }}",
      navLinks: false, // can click day/week names to navigate views
      businessHours: false, // display business hours
      editable: false,
      selectable: false,
      events: [
        @foreach ($data as $item)
          {
              title: '{{ ucwords($item->name)." - ".$item->accomodation }}',
              start: '{{ $item->datestart }}',
              end: '{{ date("Y-m-d", strtotime("+1 days", strtotime($item->dateend))) }}',
              color: '@if($item->confirmation==null) @php echo "#F3AD0F" @endphp @else @php echo "#1B8F00" @endphp @endif'
          },
          @endforeach
      ]
    });

    calendar.render();
  });

</script>
@endsection