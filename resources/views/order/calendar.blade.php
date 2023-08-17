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
                        </tr>

                        @foreach ($data as $item)
                        <tr>
                          <td>{{ $item->invoice_number }}</td>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->accomodation }}</td>

                        </tr>
                            
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
              title: '{{ $item->accomodation }}',
              start: '{{ $item->datestart }}',
              end: '{{ $item->dateend }}',
              color: '@php echo ($item->status == "pending") ? "#E21F1F" : "#1F1F1F"; @endphp'
          },
          @endforeach
      ]
    });

    calendar.render();
  });

</script>
@endsection