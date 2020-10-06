                                         
              <div class="close">
                <div class="cs-loader">
                  <div class="cs-loader-inner">
                    <label> ●</label>
                    <label> ●</label>
                    <label> ●</label>
                    <label> ●</label>
                    <label> ●</label>
                    <label> ●</label>
                  </div>
                </div>
              </div>
            {{-- <a href="{{ route('agent.agentAbsent') }}" target="_blank" class="btn btn-primary">PDF</a> --}}
              <table class="table table-hover">
                <tr>
                  <th>N°</th>
                  <th>Description</th>
                  <th>Date</th>
                  {{-- <th>Action</th> --}}
                </tr>
                @forelse($feries as $key => $ferie)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $ferie->description }}</td>
                    {{-- <td>{{ $absence->typeconge }}</td> --}}
                    <td>{{ ucfirst(\Carbon\Carbon::parse($ferie->dateincal)->locale('fr_FR')->isoFormat('ddd Do MMMM YYYY')) }}</td>
                    {{-- <td>1</td> --}}
                  </tr>
                @empty
                  <tr>
                    <td colspan="7"><p class="text-center">Aucun jour férié dans ce mois en cours</p></td>
                  </tr>
                @endforelse
              </table>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>