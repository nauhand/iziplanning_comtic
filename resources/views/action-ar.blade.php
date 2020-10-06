{{--<form class="voir_un_planning" action="{{route('archives.show',$id)}}" method="get" style="display: inline;">--}}
{{--        @csrf--}}
{{--        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">--}}
{{--        <button type="submit" data-toggle="tooltip" data-placement="top" title="voir les vacations" style="border: none; height: 17px;" class="label label-primary label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="fa fa-eye"></i></button>--}}
{{--</form>--}}

{{--<form class="supprimer_un_planning" action="{{route('archives.destroy',$id)}}" method="post" style="display: inline;">--}}
{{--        @csrf--}}
{{--        @method('delete')--}}
{{--        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">--}}
{{--        <button type="submit" data-toggle="tooltip" data-placement="top" title="supprimer ce planning" onclick="return confirm('Voulez vous vraiment supprimer ce planning ?');" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></button>--}}
{{--</form>--}}

<form class="voir_un_planning" action="{{route('archives.show',$id)}}" method="get" style="display: inline;">
    @csrf
    <input type="hidden" name="vacationid" value="{{ $vacation_id }}">
    <button type="submit" data-toggle="tooltip" data-placement="top" title="voir les vacations" style="border: none; height: 17px;" class="label label-primary label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="fa fa-eye"></i></button>
</form>

<form class="supprimer_un_planning" action="{{route('archives.destroy',$id)}}" method="post" style="display: inline;">
    @csrf
    @method('delete')
    <input type="hidden" name="vacationid" value="{{ $vacation_id }}">
    <button type="submit" data-toggle="tooltip" data-placement="top" title="supprimer ce planning" onclick="return confirm('Voulez vous vraiment supprimer ce planning ?');" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></button>
</form>