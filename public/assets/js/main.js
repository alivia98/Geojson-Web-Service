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

        $.get('/tanlong_table/edit/' + tanlong_id,function(data) {
            console.log(data);
            $("#form-tanlong input[name='tanggal']").val(data.tanggal)
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

            $('#form-tanlong').attr('action', '/tanlong_table/update/'+tanlong_id);
        });
    })

    $("#btn-add").click(function () {
        $("input, textarea").val("");
        $(".select-kecamatan option[value='0']").attr('selected','selected');

        $('#kecamatan').empty();
        $('#kecamatan').append('<option value="0" disable="true" selected="true">=== Pilih kecamatan ===</option>');

        $.each(data_kecamatan, function(index, desaObj){
            $('#kecamatan').append('<option value="'+ desaObj.kecamatan_id +'">'+ desaObj.kecamatan +'</option>');
        })

        $('#desa').empty();
        $('#desa').append('<option value="0" disable="true" selected="true">=== Pilih desa ===</option>');

        $('#form-tanlong').attr('action', '/tanlong_table/store');
    })
})