<div class="w-full flex item-center justify-center">
    <label class="input input-bordered flex items-center gap-2">
        <input type="text" placeholder="cari perusahaan..." id="search" class="form-controller" name="search">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16"
            fill="currentColor"
            class="h-4 w-4 opacity-70">
            <path
            fill-rule="evenodd"
            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
            clip-rule="evenodd" />
        </svg>
    </label>
</div>

<div class="overflow-x-auto w-full">
    <table class="table table-zebra w-full">
        <!-- head -->
        <thead>
            <tr>
            <th>ID SBR Sementara</th>
            <th>Nama Perusahaan</th>
            <th>Selengkapnya</th>
            <th>Pilih</th>
            </tr>
        </thead>
        <tbody id="cari_langsung">
            <!-- row 1 -->
            @php
                $no = 0;
            @endphp
            @if ($perusahaans->count()==0)
                <tr>
                    <td colspan="3" class="text-center text-red">Tidak ada perusahaan yang belum memiliki id sbr</td>
                </tr>
            @else
                @foreach ($perusahaans as $perusahaan)
                    @php
                        $no++;
                    @endphp
                    @if ($no <= 10)
                        <tr>
                            <td>{{$perusahaan->id_sbr}}</td>
                            <td class="max-w-xs">{{$perusahaan->nama_usaha}}</td>
                            <td>
                                <a href="{{route('perusahaan-view',['id_perusahaan' => $perusahaan->id_perusahaan])}}"
                                class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey">
                                    selengkapnya
                                </a>
                            </td>
                            <td>
                                <input type="checkbox"
                                class="checkbox perusahaan-checkbox"
                                id="perusahaan-checkbox{{ $perusahaan->id_perusahaan }}"
                                data-nama="{{ $perusahaan->id_perusahaan.'-'.$perusahaan->id_sbr.'-'.$perusahaan->nama_usaha }}"/>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
</script>
<script type="text/javascript">
    // Untuk live search
    $('#search').on('keyup',function(e){
        e.preventDefault();
        $value = $(this).val();
        $.ajax({
            type : 'get',
            url : '{{route('perusahaan-cari')}}',
            data:{'search':$value},
            success:function(response){
                $('#cari_langsung').html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ', status, error);
                console.error('Response: ', xhr.responseText);
            }
        });
    })

    function bindCheckboxEvent() {
        // Untuk pilih perusahaan
        $(document).on('change', '.perusahaan-checkbox', function() {
            var perusahaanNama = $(this).data('nama');
            var parts = perusahaanNama.split('-');
            var kotak = $('#kotak');

            if ($(this).is(':checked')) {
                // Tambahkan nama perusahaan ke dalam div 'kotak'
                kotak.append(
                    '<label class="input input-bordered h-40 m-2 bg-lightorange shadow-lg label-checkbox" id="'
                    +parts[0]+'-'+parts[1]+'">'
                    +'<div class="label">'+'<span class="label-text">'
                    +parts[1]+'-'+parts[2]+'</span>'+'</div>'+
                    '<input class="perusahaan-item pl-2" type="text" value="'
                    +parts[0]+'" name="inputs[]" readonly>'+'</label>');

            } else {
                // Hapus nama perusahaan dari dalam div 'kotak'
                $('#'+parts[0]+'-'+parts[1]).remove();
            }
        });

        // Untuk hapus nama perusahaan dari div 'kotak'
        $(document).on('click','.label-checkbox',function(){
            var id = $(this).attr('id');
            console.log('Trying to remove element with ID:', id);
            $('#'+id).remove();
        });

        // Untuk validasi form download
        $(document).ready(function() {
            $('#form-download').on('submit', function(e) {
                var labelsInKotak = $('#kotak label').length;

                if (labelsInKotak === 0) {
                    e.preventDefault(); // Mencegah pengiriman form
                    $('#warning-message-perusahaan').show(); // Tampilkan pesan peringatan
                } else {
                    $('#warning-message-perusahaan').hide(); // Sembunyikan pesan peringatan jika ada label
                }
            });
        });
    }
    bindCheckboxEvent();
</script>
