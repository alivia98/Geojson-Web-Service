$(document).ready(function () {
    $("#tipe-view").each(function () {
        initMap("maps-point","/api/showPoint")
        initMap("maps-area","/api/showArea")
        loadMaps(JSON.parse(localStorage.getItem("maps-point")))
    })

    $("#tipe-view").change(function (e) {
        e.preventDefault()
        value = $(this).val()
        $("#map-bjn").empty()
        $("#map-bjn").append("<div id='map-canvas' class='map-canvas'  style='height: 600px;'></div>")

        if (value == 1){
            loadMaps(JSON.parse(localStorage.getItem("maps-point")))
        }else{
            loadMaps(JSON.parse(localStorage.getItem("maps-area")))
        }
    })

    function initMap(key, baseurl) {
        $.ajax({
            type : 'get',
            url : baseurl,
            dataType: 'json',
            success : function(response){
                localStorage.setItem(key, JSON.stringify(response));
            }
        })
    }

    function loadMaps(data) {
        var mymap = L.map('map-canvas').setView([-7.2373719, 111.7938153], 11);

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYWxpdmlhcmFoOTgiLCJhIjoiY2p2bnZjMjk3MDRlbDQ4cGk5MTEyeXlnaSJ9.XbTgr6-iLZAygZRJ9dyvfg', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoiYWxpdmlhcmFoOTgiLCJhIjoiY2p2bnZjMjk3MDRlbDQ4cGk5MTEyeXlnaSJ9.XbTgr6-iLZAygZRJ9dyvfg'
        }).addTo(mymap);

        L.geoJSON(data, {
            onEachFeature: onEachFeature
        }).addTo(mymap);
    }

    function onEachFeature(feature, layer) {
        var popupContent =  "<div class='popup-body'> Tahun : "+ feature.properties.tahun+"</div>"+
                            "<div class='popup-body'> Desa : "+ feature.properties.nama_desa+"</div>"+
                            "<div class='popup-body'> Korban: "+ feature.properties.korban+"</div>"+
                            "<div class='popup-body'> Kerusakan : "+ feature.properties.kerusakan+"</div>"+
                            "<div class='popup-body'> Kerugian : "+ feature.properties.kerugian+"</div>"
        layer.bindPopup(popupContent);
    }

    $('body').on('shown.bs.modal', function (e) {
        setTimeout(function () {
            map.invalidateSize()
        },500)
    })

    $(".edit-modal").click(function (e) {
        tanlong_id = $(this).attr('data-id');

        $.get('/api/tanlong_table/edit/' + tanlong_id,function(data) {
            console.log(data);
            tanggal = $("#form-tanlong input[name='tanggal']").val(data.tanggal)
            $(".select-kecamatan option[value='"+data.kecamatan_id+"']").attr('selected','selected');

            desa_id = data.desa_id;
            $.get('/api/get-desa-list?kecamatan_id=' + data.kecamatan_id,function(data) {
                $('#desa').append('<option value="0" disable="true" selected="true">=== Pilih desa ===</option>');

                $.each(data, function(index, desaObj){
                    $('#desa').append('<option value="'+ desaObj.id +'" '+(desa_id === desaObj.id ? ' selected="selected"' : '')+' >'+ desaObj.nama_desa +'</option>');
                })
            });

            $("#form-tanlong input[name='korban']").val(data.korban)
            $("#form-tanlong textarea[name='kerusakan']").val(data.kerusakan)
            $("#form-tanlong input[name='kerugian']").val(data.kerugian)
            $("#form-tanlong input[name='longitude']").val(data.longitude)
            $("#form-tanlong input[name='latitude']").val(data.latitude)
            updateMarker(data.latitude, data.longitude);

        });

        $('#form-tanlong').attr('method', 'post');
        $('#form-tanlong').attr('action', '/tanlong_table/update/'+ tanlong_id);
    })

    $("#btn-add").click(function () {
        $("input, textarea").val("");
        $("input[name='_token']").val($('meta[name="csrf-token"]').attr('content'));
        $(".select-kecamatan option[value='0']").attr('selected','selected');

        $('#kecamatan').empty();
        $('#kecamatan').append('<option value="0" disable="true" selected="true">=== Pilih kecamatan ===</option>');

        $.each(data_kecamatan, function(index, desaObj){
            $('#kecamatan').append('<option value="'+ desaObj.kecamatan_id +'">'+ desaObj.kecamatan +'</option>');
        })

        $('#desa').empty();
        $('#desa').append('<option value="0" disable="true" selected="true">=== Pilih desa ===</option>');

        $('#form-tanlong').attr('action', '/tanlong_table/store');
        $('#form-tanlong').attr('method', 'post');
    })

    $(".edit-user").click(function (e) {
        user_id = $(this).attr('data-id');
        console.log(user_id);
        $.get('/user_table/edit/' + user_id ,function(data) {
            console.log(data);
            $("#form-user input[name='username']").val(data.username)
            $(".select-role option[value='"+data.role_id+"']").attr('selected','selected');
            $("#form-user input[name='email']").val(data.email)
            $("#form-user input[name='password']").val(data.password)

            $('#form-user').attr('action', '/user_table/update/'+ user_id);
            $('#form-user').attr('method', 'post');
        });
    })

    $("#btn-add-user").click(function () {
        $("input, textarea").val("");
        $("input[name='_token']").val($('meta[name="csrf-token"]').attr('content'));

        $(".select-role option[value='0']").attr('selected','selected');

        $('.select-role').empty();
        $('.select-role').append('<option value="0" disable="true" selected="true">=== Pilih Role ===</option>');

        $.each(role, function(index, desaObj){
            $('.select-role').append('<option value="'+ desaObj.role_id +'">'+ desaObj.role_name +'</option>');
        })

        $('.select-role').on('change', function(){
            $(this).val();
            console.log($(this).val());
        });

        $('#form-user').attr('action', '/user_table/store');
        $('#form-user').attr('method', 'post');
    })

    // $(".hapus-user").click(function () {
    //
    //     if( confirm('Are you sure?') )
    //     {
    //         var id = $(this).attr('id');
    //
    //         $.ajax({
    //             type: 'DELETE',
    //             url: '/user_table/hapus/'+ id,
    //             dataType: 'json',
    //             headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    //             data: {id:id,"_token": "{{ csrf_token() }}"},
    //
    //             success: function (data) {
    //                 alert('success');
    //             },
    //             error: function (data) {
    //                 alert(data);
    //             }
    //         });
    //     }
    // })

    $("#dropdown-filter").change(function () {
        var value = $(this).val();
        console.log(value);
        $("input[name='_token']").val($('meta[name="csrf-token"]').attr('content'));
        $('#select-data').empty();
        $('#select-data').append('<option value="0" disable="true" selected="true">Pilih Wilayah</option>');

        if (value == 1){
            $.each(data_kecamatan, function(index, desaObj){
                $('#select-data').append('<option value="'+ desaObj.kecamatan_id +'">'+ desaObj.kecamatan +'</option>');
            })
        }
        if (value == 2){
            $.each(data_desa, function(index, desaObj){
                $('#select-data').append('<option value="'+ desaObj.id +'">'+ desaObj.nama_desa +'</option>');
            })
        }
    })

    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var date_year=$('input.date-year');
    var options={
        format: 'yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
        viewMode: "years",
        minViewMode: "years"
    };
    date_year.datepicker(options);

    $('#btn-apply').click(function () {
        $('#table-tanlong tbody').empty();
        var filter = $("#dropdown-filter option:selected").val();
        var id = $("#select-data option:selected").val();
        var startDate = $("#filter-table input[name='start-year']").val();
        var endDate = $("#filter-table input[name='end-year']").val();

        console.log(startDate);

        if (startDate == ''){
            startDate = 2009;
        }
        if (endDate == ''){
            endDate = 2050;
        }

        $.ajax({
            type : 'post',
            url : '/api/get-tanlong-desa-list',
            data : {
                filter:filter,
                id:id,
                startDate:startDate,
                endDate:endDate,
                _token:$('meta[name="csrf-token"]').attr('content')
            },
            success : function (response) {
                console.log(response);
                indeks = 1;
                $.each(JSON.parse(response), function (index, value) {
                    data = value
                    row = "<tr>" +
                        "<td>"+indeks+"</td>" +
                        "<td>"+data.tahun+"</td>" +
                        "<td>"+data.nama_desa+"</td>" +
                        "<td>"+data.kecamatan+"</td>" +
                        "<td>\n" +
                        "                                            <button type=\"button\" class=\"btn btn-primary edit-modal\" data-id=\"{{ $t->tanlong_id }}\"\n" +
                        "                                                    data-toggle=\"modal\" data-target=\"#myModal\" target=\"/update\">\n" +
                        "                                                <i class=\"fas fa-pencil-alt\"></i>\n" +
                        "                                            </button>\n" +
                        "\n" +
                        "                                            <button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\">\n" +
                        "                                                <a class=\"fas fa-trash-alt\" href=\"/tanlong_table/hapus/{{ $t->tanlong_id }}\"></a>\n" +
                        "                                            </button>\n" +
                        "                                        </td>"
                    "</tr>"
                    $("#table-tanlong").append(row);
                    indeks++;
                });
            }
        })
    })

})