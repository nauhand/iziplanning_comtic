{{-- <a class="label label-primary label-sm" href="{{route('provisoire.show',$id)}}"><i class="fa fa-eye"></i></a> --}}
{{--<form class="voir_un_planning" action="{{route('definitif.show',$id)}}" method="get" style="display: inline;">--}}
{{--        @csrf--}}
{{--        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">--}}
{{--        <button type="submit" data-toggle="tooltip" data-placement="top" title="voir les vacations" style="border: none; height: 17px;" class="label label-primary label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="fa fa-eye"></i></button>--}}
{{--</form>--}}

{{--<form class="valider_un_planning" action="{{route('definitif.update',$id)}}" method="post" style="display: inline;">--}}
{{--        @csrf--}}
{{--        @method('put')--}}
{{--        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">--}}
{{--        <input type="hidden" name="type" value="archived">--}}
{{--        <button type="submit" data-toggle="tooltip" data-placement="top" title="archiver ce planning" style="border: none; height: 17px;" class="label label-warning label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="glyphicon glyphicon-bookmark"></i></button>--}}
{{--</form>--}}

{{--<form class="valider_un_planning" action="{{route('definitif.update',$id)}}" method="post" style="display: inline;">--}}
{{--        @csrf--}}
{{--        @method('put')--}}
{{--        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">--}}
{{--        <input type="hidden" name="type" value="provisoire">--}}
{{--        <button type="submit" data-toggle="tooltip" data-placement="top" title="passer en provisoire" style="border: none; height: 17px;" class="label label-success label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="glyphicon glyphicon-sort"></i></button>--}}
{{--</form>--}}

{{--<form class="supprimer_un_planning" action="{{route('definitif.destroy',$id)}}" method="post" style="display: inline;">--}}
{{--        @csrf--}}
{{--        @method('delete')--}}
{{--        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">--}}
{{--        <button type="submit" data-toggle="tooltip" data-placement="top" title="supprimer ce planning" onclick="return confirm('Voulez vous vraiment supprimer ce planning ?');" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></button>--}}
{{--</form>--}}

{{--<a href="{{ route('definitif.excel', ['id' => $id .'-agent-'.$vacation_id])}}" data-toggle="tooltip" data-placement="top" title="Télécharger ce planning" style="border: none; height: 17px;" class="label label-success label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o BTN-VK"></i> | EXCEL</a>--}}
{{--<a href="{{ route('definitif.pdf', ['id' => $id .'-agent-'.$vacation_id])}}" data-toggle="tooltip" data-placement="top" title="Télécharger ce planning" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-pdf-o BTN-VK"></i> | PDF</a>--}}


<form class="voir_un_planning" action="{{route('definitif.show',$id)}}" method="get" style="display: inline;">
        @csrf
        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">
        <button type="submit" data-toggle="tooltip" data-placement="top" title="voir les vacations" style="border: none; height: 17px;" class="label label-primary label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="fa fa-eye"></i></button>
</form>

<form class="valider_un_planning" action="{{route('definitif.update',$id)}}" method="post" style="display: inline;">
        @csrf
        @method('put')
        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">
        <input type="hidden" name="type" value="archived">
        <button type="submit" data-toggle="tooltip" data-placement="top" title="archiver ce planning" style="border: none; height: 17px;" class="label label-warning label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="glyphicon glyphicon-bookmark"></i></button>
</form>

<form class="valider_un_planning" action="{{route('definitif.update',$id)}}" method="post" style="display: inline;">
        @csrf
        @method('put')
        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">
        <input type="hidden" name="type" value="provisoire">
        <button type="submit" data-toggle="tooltip" data-placement="top" title="passer en provisoire" style="border: none; height: 17px;" class="label label-success label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="glyphicon glyphicon-sort"></i></button>
</form>

<form class="supprimer_un_planning" action="{{route('definitif.destroy',$id)}}" method="post" style="display: inline;">
        @csrf
        @method('delete')
        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">
        <button type="submit" data-toggle="tooltip" data-placement="top" title="supprimer ce planning" onclick="return confirm('Voulez vous vraiment supprimer ce planning ?');" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></button>
</form>

<a href="{{ route('planning.definitif.vaccation.excel', ['id' => $id ])}}" data-toggle="tooltip" data-placement="top" title="Télécharger ce planning" style="border: none; height: 17px;" class="label label-success label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o BTN-VK"></i> | EXCEL</a>
<a href="{{ route('planning.definitif.vaccation.pdf', ['id' => $id])}}" data-toggle="tooltip" data-placement="top" title="Télécharger ce planning" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-pdf-o BTN-VK"></i> | PDF</a>