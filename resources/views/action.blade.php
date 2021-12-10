{{-- <a class="label label-primary label-sm" href="{{route('provisoire.show',$id)}}"><i class="fa fa-eye"></i></a> --}}
<form class="voir_un_planning" action="{{route('provisoire.show',$id)}}" method="get" style="display: inline;">
        @csrf
        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">
        <button type="submit" data-toggle="tooltip" data-placement="top" title="voir les vacations" style="border: none; height: 17px;" class="label label-primary label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="fa fa-eye"></i></button>
</form>

<form class="valider_un_planning" action="{{route('provisoire.update',$id)}}" method="post" style="display: inline;">
        @csrf
        @method('put')
        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">
        <button type="submit" data-toggle="tooltip" data-placement="top" title="valider ce planning" style="border: none; height: 17px;" class="label label-success label-sm" data-toggle="tooltip" data-placement="top" target="_blank"><i class="fa fa-check"></i></button>
</form>

<form class="supprimer_un_planning" action="{{route('provisoire.destroy',$id)}}" method="post" style="display: inline;">
        @csrf
        @method('delete')
        <input type="hidden" name="vacationid" value="{{ $vacation_id }}">
        <button type="submit" data-toggle="tooltip" data-placement="top" title="supprimer ce planning" onclick="return confirm('Voulez vous vraiment supprimer ce planning ?');" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></button>
</form>

<a href="{{ route('planning.provisoire.vaccation.excel', $id)}}" data-toggle="tooltip" data-placement="top" title="Télécharger ce planning" style="border: none; height: 17px;" class="label label-success label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-excel-o BTN-VK"></i> | EXCEL</a>
<a href="{{ route('planning.provisoire.vaccation.pdf', $id)}}" data-toggle="tooltip" data-placement="top" title="Télécharger ce planning" style="border: none; height: 17px;" class="label label-danger label-sm" data-toggle="tooltip" data-placement="top"><i class="fa fa-file-pdf-o BTN-VK"></i> | PDF</a>

