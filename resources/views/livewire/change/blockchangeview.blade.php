<div class="" style="margin-bottom:50px">
  <table class="table table-bordered ">
    <thead>

      <th>DATE</th>
      <th>BLOCK CHANGE DESCRIPTION</th>
    </thead>
    <tbody>
      @if($blockevents)
      @foreach ($blockevents as $event )
        <tr>

          <td>{{$event->created_at}}</td>
          <td>{{$event->eventlog_desc}}</td>
        </tr>
      @endforeach
    @endif

    </tbody>
  </table>
</div>
