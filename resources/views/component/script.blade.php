<script src="{{ mix('js/app.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/printThis.js') }}"></script>

<script>
    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
    $(document).ready(function() {
        $('table#tableId').on('input', 'input.qty', function() {
            var $row = $(this).closest('tr');
            var quantity = $row.find('input.qty').val() || 0;
            var total = quantity;
            $row.find('span.total').text(total);
        });

        $('table#tableId').on('input', 'input.qty', function() {
            var grandTotal = 0;
            $('table#tableId tbody tr').each(function() {
                var total = parseInt($(this).find('span.total').text()) || 0;
                grandTotal += total;
            });
            $('#grandTotal').text(`${grandTotal} Kg`);
        });


        $("#print-btn").click(function() {
            // let divToPrint = document.getElementById("print-slip");
            // newWin = window.open("");
            // newWin.document.write(divToPrint.outerHTML);
            // newWin.print();
            // newWin.close();
            $('#print-slip').printThis();
        });
        $("#checkbox-input").change(function() {
            if (this.checked) {
                $("#submit-button").removeAttr("disabled");
                $("#submit-button").removeClass(
                    "text-white bg-blue-400 cursor-not-allowed hover:bg-blue-500 focus:ring-4 focus:ring-blue-400 font-medium rounded-lg text-sm w-full py-2.5 mr-2 mb-2 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none dark:focus:ring-blue-800"
                );
                $("#submit-button").addClass(
                    "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                );
            } else {
                $("#submit-button").attr("disabled", "disabled");
                $("#submit-button").removeClass(
                    "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                );
                $("#submit-button").addClass(
                    "text-white bg-blue-400 cursor-not-allowed hover:bg-blue-500 focus:ring-4 focus:ring-blue-400 font-medium rounded-lg text-sm w-full py-2.5 mr-2 mb-2 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none dark:focus:ring-blue-800"
                );
            }
        });




        @if (isset($data_barang))
            barang = {!! $data_barang !!}
            var kode_barang = $.map(barang, function(obj) {
                return {
                    id: parseInt(obj.kode_material),
                    text: obj.kode_material
                }
            });

            var nama_barang = $.map(barang, function(obj) {
                return {
                    id: obj.nama_material,
                    text: obj.nama_material
                }
            });
        @else
            kode_barang = []
            nama_barang = []
        @endif

        elemSelect = $('#row1 .select2')
        elemName = $('#row1 .select3')
        elemSelect.select2({
            theme: 'bootstrap4',
            width: '100%',
            allowClear: true,
            placeholder: $(this).data('placeholder'),
            data: kode_barang
        });
        elemName.select2({
            theme: 'bootstrap4',
            width: '100%',
            allowClear: true,
            placeholder: $(this).data('placeholder'),
            data: nama_barang
        });
        elemSelect.on('change', function(data) {
            let index_barang = barang.find(({
                kode_material
            }) => kode_material === `${$(this).val()}`);

            elemName.val(index_barang['nama_material']).trigger('change')
        })

        elemName.on('change', function(data) {
            let index_nama_material = barang.find(({
                nama_material
            }) => nama_material === `${$(this).val()}`);

            elemSelect.val(index_nama_material['kode_material']).trigger('change')

        })
        $('#addRow').click(function() {

            // Get the next row ID
            var nextRowId = $('#tableId tbody tr').length + 1;

            // Add a new row to the table
            $('#tableId tbody').append(`
                <tr id="row${nextRowId}" class='tr_input bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                    <td class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="form-group">
                            <select data-placeholder="pilih/cari nomor material" data-allow-clear="true"
                                class="select2 p-2" name="nomor_material[]" style="width: 100%;">
                                <option></option>
                            </select>
                    </td>
                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="form-group">
                            <select data-placeholder="pilih/cari nama material" data-allow-clear="true"
                                class="select3 p-2" name="nama_material[]" style="width: 100%;">
                                <option></option>
                            </select>
                    </td>
                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <input type='number' name="jumlah[]" id="qty${nextRowId}"
                            class='qty bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'>
                    </td>
                    <td>
                        <span class="total" hidden></span>
                    </td>
                    <td>
                        <a type="button"
                            class="deleteRow text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Hapus
                            material</a>
                        </div>
                    </td>
                </tr>
                        `);

            // Initialize Select2 for the new row
            elemSelectNextRow = $(`#row${nextRowId} .select2`)
            elemNameNextRow = $(`#row${nextRowId} .select3`)
            elemSelectNextRow.select2({
                theme: 'bootstrap4',
                width: '100%',
                allowClear: true,
                placeholder: $(this).data('placeholder'),
                data: kode_barang
            });

            elemNameNextRow.select2({
                theme: 'bootstrap4',
                width: '100%',
                allowClear: true,
                placeholder: $(this).data('placeholder'),
                data: nama_barang
            });

            elemSelectNextRow.on('change', function(data) {
                let index_barang = barang.find(({
                    kode_material
                }) => kode_material === `${$(this).val()}`);

                elemNameNextRow.val(index_barang['nama_material']).trigger('change')
            })

            elemNameNextRow.on('change', function(data) {
                let index_nama_material = barang.find(({
                    nama_material
                }) => nama_material === `${$(this).val()}`);

                elemSelectNextRow.val(index_nama_material['kode_material']).trigger('change')

            })
        });
        // Delete a row when the Delete button is clicked
        $(document).on('click', '.deleteRow', function() {
            // Remove the row
            $(this).closest('tr').remove();
        });

        // var lastname_id = $('.tr_input select:nth-child(1)').last().attr('id');
        // var split_id = lastname_id.split('_');
        // var index = Number(split_id[1]);

        $('#kendaraan').select2({
            theme: 'bootstrap4'
        });
        $('#id_pelanggan').select2({
            theme: 'bootstrap4'
        });

        // $('.tr_select select').each(function() {

        //     // elemSelect = $('#username_' + $(this).attr('id').split('_')[1]);
        //     // elemSelect.select2({
        //     //     theme: 'bootstrap4',
        //     //     width: 'element',
        //     //     allowClear: true,
        //     //     placeholder: $(this).data('placeholder'),
        //     //     data: kode_barang
        //     // });

        //     // elemName = $('#name_' + $(this).attr('id').split('_')[1]);
        //     // elemName.select2({
        //     //     theme: 'bootstrap4',
        //     //     width: 'element',
        //     //     allowClear: true,
        //     //     placeholder: $(this).data('placeholder'),
        //     //     data: nama_barang
        //     // });
        // })


        elemSelect.on('change', function(data) {
            let index_barang = barang.find(({
                kode_material
            }) => kode_material === `${$(this).val()}`);

            $('#name_' + Number(split_id[1]) + ' > option').each(function(id, data_nama) {
                if (data_nama.text === index_barang['nama_material']) {
                    $('#name_' + Number(split_id[1])).val(data_nama.text).trigger(
                        'change')
                }
            })
        })

        elemName.on('change', function(data) {
            let index_nama_material = barang.find(({
                nama_material
            }) => nama_material === `${$(this).val()}`);

            $('#username_' + Number(split_id[1]) + ' > option').each(function(id,
                data_nama) {
                if (data_nama.text === index_nama_material['kode_material']) {
                    $('#username_' + Number(split_id[1])).val(data_nama.text)
                        .trigger('change')
                }
            })

        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });


        $(document).on('click', '#btn-hapus', function() {
            let hapus = $(this).data('row')
            $('#' + hapus).remove()
            baris = 0
        })
        material = []
        jumlah = []
        $(document).on('click', '#btn-submit', function() {
            $('#table1 tr').each(function(i, v) {
                if ($('#username_' + i).val() != undefined && $('#age_' + i)
                    .val() !=
                    undefined) {
                    material.push($('#username_' + i).val())
                    jumlah.push($('#age_' + i).val())
                }
            })
            // $('.tr_input').each(function(i,v){
            //     console.log($('#username_'+i).val())
            // })



            $.ajax({
                url: "{{ route('tambah-surat-keluar-proses') }}",
                type: 'POST',
                data: {
                    nomor_sipb: $('#nomor_sipb').val(),
                    nomor_kendaraan: $('#kendaraan').val(),
                    nama_gudang: $('#nama_gudang').val(),
                    tanggal_terbit: $('#tanggal_terbit').val(),
                    keterangan: $('#keterangan').val(),
                    id_pelanggan: $('#id_pelanggan').val(),
                    material: [],
                    jumlah: [],
                    "_token": "{{ csrf_token() }}",
                },
                dataType: 'json',
                success: function(res) {
                    window.location.href = "{{ route('surat-keluar') }}"
                },
                error: function(xhr) {

                    console.log(xhr)

                }
            })
        })

        id_sipb = ""
        $('select#nomor_sipb').change(function() {
            id_sipb = $('select#nomor_sipb').val()
        })


        $('select#nomor_slip').on('change', function() {
            $('tbody').empty();
            $.ajax({
                url: "{{ route('cari data jadwal') }}",
                dataType: 'json',
                method: 'POST',
                data: {
                    'nomor_slip': `${$(this).val()}`,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(res) {
                    let htmlView = '';
                    console.log(res)
                    $('#alamat').val(res.data_slip.alamat)
                    $('#keterangan').val(res.data_sipb.keterangan)
                    $('#nomor_kendaraan').val(res.data_sipb.nomor_kendaraan)
                    $('#nomor_sipb').val(res.data_sipb.nomor_sipb)

                    for (let index = 0; index < res.data_barang
                        .length; index++) {
                        console.log(index)
                        htmlView +=
                            `
                    <tr id="baris" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    ` + (index + 1) + `
                        </th>
                    <td class="py-4 px-6">` + res.data_barang[index].nomor_material + `
                    </td>
                    <td class="py-4 px-6">` + res.data_barang[index].nama_material + `
                    </td>
                    <td class="py-4 px-6">` + res.data_barang[index].satuan + `
                    </td>
                    <td class="py-4 px-6">` + res.data_barang[index].jumlah + `
                    </td>
                    </tr>
                        `
                    }
                    $('tbody').append(htmlView)
                },
                error: function(xhr) {
                    console.log(xhr)
                    $('#alamat').val('')
                    $('tanggal_berangkat').val('{{ date('Y-m-d') }}')
                    $('#keterangan').val('')
                    $('#nomor_kendaraan').val('')
                    $('#nomor_sipb').val('')
                }
            })
        })

        $('select#id_pelanggan').on('change', function() {
            // $('tbody').empty();
            $.ajax({
                url: "{{ route('cari data pelanggan') }}",
                dataType: 'json',
                method: 'POST',
                data: {
                    'id_pelanggan': `${$(this).val()}`,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(res) {
                    // let htmlView = '';
                    console.log(res)
                    $('#alamat_perusahaan').val(res.alamat)
                    // $('#keterangan').val(res.data_sipb.keterangan)
                    // $('#nomor_kendaraan').val(res.data_sipb.nomor_kendaraan)
                    // $('#nomor_sipb').val(res.data_sipb.nomor_sipb)

                    // for (let index = 0; index < res.data_barang
                    //     .length; index++) {
                    //     console.log(index)
                    //     htmlView +=
                    //         `
                    // <tr id="baris" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    // <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    // ` + (index + 1) + `
                    //     </th>
                    // <td class="py-4 px-6">` + res.data_barang[index].nomor_material + `
                    // </td>
                    // <td class="py-4 px-6">` + res.data_barang[index].nama_material + `
                    // </td>
                    // <td class="py-4 px-6">` + res.data_barang[index].satuan + `
                    // </td>
                    // <td class="py-4 px-6">` + res.data_barang[index].jumlah + `
                    // </td>
                    // </tr>
                    //     `
                    // }
                    // $('tbody').append(htmlView)
                },
                error: function(xhr) {
                    console.log(xhr)
                    $('#alamat').val('')
                    $('tanggal_berangkat').val('{{ date('Y-m-d') }}')
                    $('#keterangan').val('')
                    $('#nomor_kendaraan').val('')
                    $('#nomor_sipb').val('')
                }
            })
        })

        // $('.nomor_material').autocomplete({
        //     source: function(request, response ) {
        //         $.ajax({
        //             url: "{{ route('autosearch') }}",
        //             type: 'GET',
        //             dataType: "json",
        //             data: {
        //                 search: request.term
        //             },
        //             success: function(data) {
        //                 console.log(data)
        //                 response(data);
        //             }
        //         });
        //     },
        //     select: function(event, ui) {
        //         $('.nomor_material').val(ui.item.label);
        //         $('.nama_material').html(ui.item.value);
        //         console.log(ui.item);
        //         return false;
        //     }
        // })

        $(document).on('keydown', '.username', function() {

            var id = this.id;
            var splitid = id.split('_');
            var index = splitid[1];

            // Initialize jQuery UI autocomplete
            $('#' + id).autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('autosearch') }}",
                        type: 'get',
                        dataType: "json",
                        data: {
                            search: request.term,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#' + id).val(ui.item.label); // display the selected text
                    var userid = ui.item.value; // selected value

                    // AJAX
                    // $.ajax({
                    //     url: "{{ route('autosearch') }}",
                    //     type: 'get',
                    //     data: {
                    //         userid: userid,
                    //         request: 2
                    //     },
                    //     dataType: 'json',
                    //     success: function(response) {

                    //         var len = response.length;

                    //         if (len > 0) {
                    //             var id = response[0]['id'];
                    //             var name = response[0]['name'];
                    //             var email = response[0]['email'];
                    //             var age = response[0]['age'];


                    //             // Set value to textboxes
                    //             document.getElementById('name_' + index).value =
                    //                 name;
                    //             document.getElementById('age_' + index).value =
                    //                 age;
                    //             document.getElementById('email_' + index)
                    //                 .value = email;


                    //         }

                    //     }
                    // });
                    // Set value to textboxes
                    // document.getElementById('name_' + index).value =
                    //     userid;
                    $('#name_' + index).val(userid)
                    return false;
                }
            });
        });

        // Add more
        $('#addmore').click(function() {
            // Get last id
            // var lastname_id = $('.tr_input input:nth-child(1)').last().attr('id');
            // var split_id = lastname_id.split('_');
            // var index = Number(split_id[1]) + 1;
            if ($('.tr_input input[type=text]').length === 0) {

                // elemSelect = $('#username_1');
                // elemSelect.select2({
                //     theme: 'bootstrap4',
                //     width: 'element',
                //     allowClear: true,
                //     placeholder: $(this).data('placeholder'),
                //     data: kode_barang
                // });

                // elemName = $('#name_1');
                // elemName.select2({
                //     theme: 'bootstrap4',
                //     width: 'element',
                //     allowClear: true,
                //     placeholder: $(this).data('placeholder'),
                //     data: nama_barang
                // });
                var html = ""
                html +=
                    "<tr class='tr_input bg-white border-b dark:bg-gray-800 dark:border-gray-700'>"
                html +=
                    "<td class='py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white'>"
                html += "<div class='form-group'>"
                html +=
                    "<input type='text' class='username nomor_material bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                html += "id='username_" + 1 +
                    "'  name='nomor_material[]' style='width: 100%;'>"
                html += "<option></option></select></td>"

                html +=
                    "<td class='py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white'>"
                html +=
                    "<input type='text' class='name bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' id='name_" +
                    1 + "' readonly></td>"
                html +=
                    "<td class='py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white'>"
                html +=
                    "<input type='number' name='jumlah[]' class='age jumlah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' id='age_" +
                    1 + "'></td>"
                html += "<td>"
                html += '<a type="button" onclick="deleteRow(this)"'
                html +=
                    'class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"'
                html += 'id="btn-tambah">Hapus material</a>'
                html += "</td>"
                html += "</tr>"
                // Append data
                $('tbody').append(html);
            } else {

                var lastname_id = $('.tr_input input[type=text]:nth-last-child(1)').last().attr('id');
                var split_id = lastname_id.split('_');
                var index = Number(split_id[1]) + 1;
                // New index
                // var index = Number(split_id[1]) + 1;
                // elemSelect = $('#username_' + index);
                // elemSelect.select2({
                //     theme: 'bootstrap4',
                //     width: 'element',
                //     allowClear: true,
                //     placeholder: $(this).data('placeholder'),
                //     data: kode_barang
                // });

                // elemName = $('#name_' + index);
                // elemName.select2({
                //     theme: 'bootstrap4',
                //     width: 'element',
                //     allowClear: true,
                //     placeholder: $(this).data('placeholder'),
                //     data: nama_barang
                // });
                var html = ""
                html +=
                    "<tr class='tr_input bg-white border-b dark:bg-gray-800 dark:border-gray-700'>"
                html +=
                    "<td class='py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white'>"
                html +=
                    "<input type='text' class='username nomor_material bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"
                html += "id='username_" + index +
                    "' name='nomor_material[]' style='width: 100%;'>"
                html += "<option></option></select></td>"

                html +=
                    "<td class='py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white'>"
                html +=
                    "<input type='text' class='name bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' id='name_" +
                    index + "' readonly></td>"
                html +=
                    "<td class='py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white'>"
                html +=
                    "<input type='number' name='jumlah[]' class='age jumlah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500' id='age_" +
                    index + "'></td>"
                html += "<td>"
                html += '<a type="button" onclick="deleteRow(this)"'
                html +=
                    'class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"'
                html += 'id="btn-tambah">Hapus material</a>'
                html += "</td>"
                html += "</tr>"
                // Append data
                $('tbody').append(html);
            }


        });

        material_edit = []
        jumlah_edit = []
        $(document).on('click', '#btn-submit-edit', function() {
            $('#table1 tr').each(function(i, v) {
                // if ($('#username_' + i).val() != undefined && $('#age_' + i).val() !=
                //     undefined) {
                //     // material_edit.push($('#username_' + i).val())
                //     // jumlah_edit.push($('#age_' + i).val())
                // }
                console.log($('#username_' + i).val())
                console.log($('#age_' + i).val())
            })

            // console.log(material_edit)
            // console.log(jumlah_edit)
            // $('.tr_input').each(function(i,v){
            //     console.log($('#username_'+i).val())
            // })



            $.ajax({
                url: "{{ route('edit-surat-keluar-proses') }}",
                type: 'POST',
                data: {
                    nomor_sipb: $('#nomor_sipb').val(),
                    nomor_kendaraan: $('#kendaraan').val(),
                    nama_gudang: $('#nama_gudang').val(),
                    tanggal_terbit: $('#tanggal_terbit').val(),
                    keterangan: $('#keterangan').val(),
                    id_pelanggan: $('#id_pelanggan').val(),
                    material: 1,
                    jumlah: 1,
                    "_token": "{{ csrf_token() }}",
                },
                dataType: 'json',
                success: function(res) {
                    window.location.href = "{{ route('surat-keluar') }}"
                },
                error: function(xhr) {

                    console.log(xhr)

                }
            })
        })

    })
</script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        table = $('#tabelSIPB').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    text: 'Copy',
                    extend: 'copy',
                    className: 'red focus:outline-none text-white mb-4 bg-blue-400 hover:bg-blue-500 focus:ring-4 text-center focus:ring-blue-300 font-medium rounded-lg text-sm mr-2 dark:focus:ring-yellow-900'
                },
                {
                    extend: 'csv',
                    className: 'excelButton'
                },

                {
                    extend: 'excel',
                    className: 'excelButton'
                },
                {
                    extend: 'pdf',
                    className: 'copyButton'
                },
                {
                    text: 'print',
                    extend: 'print',
                    className: 'excelButton'
                }

            ],
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [5, 'desc']
            ],

        });
        $('#tabelSIPB_filter').remove()
        $('#search').on('keyup', function() {
            table.search($(this).val()).draw();
        });
        tableSlip = $('#tabelSlip').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csv',
                    className: 'excelButton'
                },

                {
                    extend: 'excel',
                    className: 'excelButton'
                },
                {
                    extend: 'pdf',
                    className: 'copyButton'
                },
                {
                    text: 'print',
                    extend: 'print',
                    className: 'excelButton'
                }

            ],
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [2, 'desc']
            ],

        })
        $('#tabelSlip_filter').remove()
        $('#searchSlip').on('keyup', function() {
            table.search($(this).val()).draw();
        });
        tablePenjadwalan = $('#tabelPenjadwalan').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csv',
                    className: 'excelButton'
                },

                {
                    extend: 'excel',
                    className: 'excelButton'
                },
                {
                    extend: 'pdf',
                    className: 'copyButton'
                },
                {
                    text: 'print',
                    extend: 'print',
                    className: 'excelButton'
                }

            ],
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [6, 'desc']
            ],

        })
        $('#tabelPenjadwalan_filter').remove()
        // $('#searchSlip').on('keyup', function() {
        //     table.search($(this).val()).draw();
        // });


        table = $('#tableInputSIPB').DataTable({
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [6, 'desc']
            ],
        });
        $('#tableInputSIPB_filter').remove();
        $('#search').on('keyup', function() {
            table.search($(this).val()).draw();
        });
        $('#tableInputSIPB_length').addClass('mb-5');
        $('.paginate_button').addClass(
            'focus:outline-none text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 text-center focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:focus:ring-yellow-900'
        );

        $('#tableInputSIPB_info').addClass('mb-5');


        table = $('#sipbSL').DataTable({
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [2, 'desc']
            ],
        });
        $('#sipbSL_filter').remove();
        $('#search').on('keyup', function() {
            table.search($(this).val()).draw();
        });

        table = $('#table_schedule').DataTable({
            order: [
                [4, 'desc'],
                [5, 'asc'],

            ],
        });

        $('#table_schedule_filter').remove();
        $('#search').on('keyup', function() {
            table.search($(this).val()).draw();
        });
    });
</script>
