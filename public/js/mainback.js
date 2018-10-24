$(document).ready(function () {
  try {
    $('#datetimepicker1').datetimepicker({
      inline: true,
      sideBySide: true
    })
  } catch (err) {
    console.log('inicializar')
  }

  $('.select2').select2()

  $('.btn-cambiofecha').click(function (e) {
    e.preventDefault()

    let idcliente = $(this).data('idcliente')
    let idasociado = $(this).data('idasociado')
    let order_id = $(this).data('id')


    $('#fr-cambiofecha #order_id').val(order_id)
    $('#fr-cambiofecha #cliente_id').val(idcliente)
    $('#fr-cambiofecha #asociado_id').val(idasociado)

    fetch(`getfecha/${order_id}`)
      .then(res => res.json())
      .catch(error => console.error('error', error))
      .then(response => {
       
          let fecha = response.request_date.split(' ');
          let gen1 = fecha[0];
          let gen2 = fecha[1];
          let gen3 = fecha[2];

          let thm = gen2.split(':');
          let hora = thm[0];
          let minuto = thm[1];
          
          
        document.getElementById('datepicker').value =gen1;
       
        $('#fr-cambiofecha #horas').val(hora);
        $('#fr-cambiofecha #minutos').val(minuto);

       
        if(gen3==="AM"){
            document.getElementById('periodo2').value = gen3;
            let periodo= document.getElementById('periodo2');
            periodo.checked = true;
        }else{
            document.getElementById('periodo3').value = gen3;
            let periodo= document.getElementById('periodo3');
            periodo.checked = true;
        } 
       
      })

    $('#modal-cambiofecha').modal('show')
  })

  $('.btn-save-cambiofecha').click(function (e) {
    e.preventDefault()

    let order_id = $('#fr-cambiofecha #order_id').val();
    let cliente_id = $('#fr-cambiofecha #cliente_id').val();
    let asociado_id = $('#fr-cambiofecha #asociado_id').val();
    let token = document.querySelector("input[name$='_token']").value;
    let dia = document.getElementById('datepicker').value;
    let hora = $('#fr-cambiofecha #horas').val();
    let minuto =$('#fr-cambiofecha #minutos').val();
    let periodo = $('#fr-cambiofecha input[name=periodos]:checked').val();
   
    let datasend = ({
        '_method': 'PATCH',
        '_token': token,
        'order_id': order_id,
        'asociado_id': asociado_id,
        'cliente_id': cliente_id,
        'tiempos': periodo, 
        'dia': dia,
        'hora': hora,
        'minuto': minuto  
    });
    
    let url = `/admin/cambiofecha/${order_id}`
    // ajax
    fetch(url, {
      method: 'POST',
      body: JSON.stringify(datasend),
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(res => res.json())
      .catch(error => console.error('error: ', error))
      .then(response => {
        
        if(response.sistema){
          alert(response.sistem);
        }
    
    })

    $('#modal-cambiofecha').modal('hide')
      window.location.reload()
  })

  $('#datepicker').datepicker({
    autoclose: true
  });
  $('#datepickerget').datepicker({
    autoclose: true
  })

  $('.btn-nuevo-marca').click(function (e) {
    e.preventDefault()
    $('#modal-edit-marca').modal('show')
  })

  $('.marca-edit').click(function (e) {
    e.preventDefault()

    id = $(this).data('id')
    document.querySelector("input[name$='_method']").value = 'PUT'
    document.getElementById('id').value = id
    $('.modal-title').html('Editar Marca')

    let url = `/admin/marca/${id}/edit`
    fetch(url)
      .then(res => res.json())
      .catch(error => console.error('error', error))
      .then(response => {
        console.log(response)
        // injection


        document.getElementById('marca').value = response.marcas.name
        $.each(response.years, function (i, e) {
          console.log(e.year)

          $(`#yearsmake option[value=${e.year}]`).attr('selected', true)
        })

        $('#yearsmake').select2()


        $('#modal-edit-marca').modal('show')
      })
  })
  // save new make
  $('.btn-save-marca').click(function (e) {
    e.preventDefault()

    let marca = document.getElementById('marca').value
    let id = document.getElementById('id').value
    let url = ''
    let method = document.querySelector("input[name$='_method']").value
    let token = document.querySelector("input[name$='_token']").value

    var selectednumbers = []
    $('#yearsmake :selected').each(function (i, selected) {
      selectednumbers[i] = $(selected).val()
    })
    let data = ({'_method': method,'_token': token,'name': marca,'yearmake': selectednumbers})
    if (method == 'POST') {
      url = '/admin/marca'
      console.log('nuevo')
    }else {
      url = `/admin/marca/${id}`
      console.log('actualiza')
    }
    // ajax
    fetch(url, {
      method: 'POST',
      body: JSON.stringify(data),
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(res => res.json())
      .catch(error => console.error('error: ', error))
      .then(response => console.log('Success: ', response))

    $('#modal-edit-marca').modal('hide')
    window.location.reload()
  })

  $('.btn-nuevo-modelo').click(function (e) {
    e.preventDefault()
    $('#modal-edit-modelo').modal('show')
  })

  $('#marcamodel').change(function () {
    var id = $(this).val()

    var ioption = ''
    let url = `/admin/getyear/${id}`
    fetch(url)
      .then(res => res.json())
      .catch(error => console.error('error', error))
      .then(response => {

        // injection

        $.each(response, function (i, e) {
          ioption = ioption + `<option value="${e.id}">${e.year}</option>`
        })
        $('#yearmodel').html(ioption)
      })
  })

  $('.btn-save-modelo').click(function (e) {
    e.preventDefault()

    let modelo = document.getElementById('modelo').value
    let id = document.getElementById('id').value
    let makeyear_id = document.getElementById('yearmodel').value
    let url = ''
    let method = document.querySelector("input[name$='_method']").value
    let token = document.querySelector("input[name$='_token']").value

    var selectednumbers = []
    $('#yearsmake :selected').each(function (i, selected) {
      selectednumbers[i] = $(selected).val()
    })
    let data = ({'_method': method,'_token': token,'name': modelo,'makeyear_id': makeyear_id})
    if (method == 'POST') {
      url = '/admin/modelo'
      console.log('nuevo')
    }else {
      url = `/admin/modelo/${id}`
      console.log('actualiza')
    }
    // ajax
    fetch(url, {
      method: 'POST',
      body: JSON.stringify(data),
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(res => res.json())
      .catch(error => console.error('error: ', error))
      .then(response => console.log('Success: ', response))

    $('#modal-edit-modelo').modal('hide')
    window.location.reload()
  })


  $('.modelo-edit').click(function (e) {
    e.preventDefault()
    let ioption = ''
    id = $(this).data('id')
    document.querySelector("input[name$='_method']").value = 'PUT'
    document.getElementById('id').value = id
    $('.modal-title').html('Editar Modelo')

    let url = `/admin/modelo/${id}/edit`
    fetch(url)
      .then(res => res.json())
      .catch(error => console.error('error', error))
      .then(response => {
        console.log(response)
        // injection


        document.getElementById('modelo').value = response.modelos.name

        document.getElementById('marcamodel').value = response.marcaid

        $.each(response.years, function (i, e) {
          ioption = ioption + `<option value="${e.id}">${e.year}</option>`
        })
        $('#yearmodel').html(ioption)

        document.getElementById('yearmodel').value = response.yearid

        $('#modal-edit-modelo').modal('show')
      })
  })

  $('.modelo-borrar').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')
    if (confirm('Esta seguro de eliminar este item')) {
      let method = 'DELETE'
      let token = document.querySelector("input[name$='_token']").value
      let data = ({'_method': method,'_token': token,'id': id})
      let url = `/admin/modelo/${id}`
      fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
          'Content-Type': 'application/json'
        }
      }).then(res => res.json())
        .catch(error => console.error('error: ', error))
        .then(response => console.log('Success: ', response))

      window.location.reload()
    } else {
      return false
    }
  })

  $('.marca-borrar').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')
    if (confirm('Esta seguro de eliminar este item')) {
      let method = 'DELETE'
      let token = document.querySelector("input[name$='_token']").value
      let data = ({'_method': method,'_token': token,'id': id})
      let url = `/admin/marca/${id}`
      fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
          'Content-Type': 'application/json'
        }
      }).then(res => res.json())
        .catch(error => console.error('error: ', error))
        .then(response => console.log('Success: ', response))

        // window.location.reload()

    } else {
      return false
    }
  })

  $('.btn-listasociados-delete').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')
    if (confirm('Esta seguro de eliminar Usuario')) {
      let method = 'DELETE'
      let token = $("#fr-delete input[name$='_token']").val()

      let data = ({'_method': method,'_token': token,'id': id})
      let url = `/admin/listasociados/${id}`
      fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
          'Content-Type': 'application/json'
        }
      }).then(res => res.json())
        .catch(error => console.error('error: ', error))
        .then(response => console.log('Success: ', response))

      window.location.reload()
    } else {
      return false
    }
  })

  $('.btn-listcliente-editar').click(function (e) {
    e.preventDefault()
    let id = $(this).data('id')




    let url = `/admin/listclientes/${id}/edit`



    fetch(url).then(res => res.json())
      .catch(error => console.error('error: ', error))
      .then(response => {
        $('#fr-edit-listcliente #id').val(id)
        $('#fr-edit-listcliente #nombre').val(response.datos.name)
        $('#fr-edit-listcliente #email').val(response.datos.email)
        $('#modal-editlistcliente').modal('show')
      })
  })

  $('.btn-save-listusuario').click(function (e) {
    e.preventDefault()
    let token = $("#fr-edit-listcliente input[name$='_token']").val()
    let nombre = $('#fr-edit-listcliente #nombre').val()
    let email = $('#fr-edit-listcliente #email').val()
    let id = $('#fr-edit-listcliente #id').val()


    let url = `/admin/listclientes/${id}`

    let data = ({'_method': 'PUT','_token': token,'nombre': nombre,'email': email})

    fetch(url, {
      method: 'POST',
      body: JSON.stringify(data),
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(res => res.json())
      .catch(error => console.error('error: ', error))
      .then(response => {
        console.log(response)
        window.location.reload()
      })
  })
  $('.btn-listcliente-delete').click(function (e) {
    e.preventDefault()
    let id = $(this).data('id')

    if (confirm('Esta seguro de eliminar Usuario')) {
      let token = $("#fr-edit-listcliente input[name$='_token']").val()


      let url = `/admin/listclientes/${id}`

      let data = ({'_method': 'DELETE','_token': token})

      fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
          'Content-Type': 'application/json'
        }
      }).then(res => res.json())
        .catch(error => console.error('error: ', error))
        .then(response => {
          console.log(response)
          window.location.reload()
        })
    }
  })

  $('#service').change(function () {
    console.log('iniciando servicio..')
    var id = $(this).val()
    var ghtm = ''
    var isel = $('option:selected', this).text()

    if (isel === 'Otro tipo de servicios') {
      $('.otro-servicio').fadeIn(350, 'swing')
    } else {
      $('.otro-servicio').fadeOut(350, 'swing')
    }
    $.ajax({
      url: '/servicios/' + id,
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        $.each(response.services, function (i, e) {
          ghtm = ghtm + `<option value="${e.id}">${e.name}</option>`
        })

        $('#subservice').html(ghtm)
      }

    })
  })

  $('#subservice').change(function () {
    $('.datatimer').removeClass('oculto')
  })

  try {
    $('#picker1').datetimepicker({
      format: 'HH:mm',
      stepping: 30,

      defaultDate: moment('2018-01-01'),
      useCurrent: 'day'

    })

    $('#picker2').datetimepicker({
      format: 'LTS',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')

    })

    $('#sem1').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem2').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem3').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem4').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem5').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem6').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem7').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem8').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem9').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem10').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem11').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem12').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem13').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem14').datetimepicker({
      format: 'LT',
      stepping: 30,
      minDate: moment().startOf('day'),
      maxDate: moment().endOf('day')
    })

    $('#sem15').daterangepicker()
    $('#sem16').daterangepicker()
    $('#sem17').daterangepicker()
    $('#sem18').daterangepicker()
  } catch (err) {
    console.log('no inicializado')
  }

  $('.addphone').click(function (e) {
    e.preventDefault()
    console.log('telefono')
    var htm = '<div class="form-group stack"><label for="telefono">Telefono</label> <input type="text" class="form-control" name="phone[]" ></div>'
    $('#telefonos').append(htm)
    numstack()
  })

  $('.addphoto').click(function (e) {
    e.preventDefault()
    console.log('foto')
    var ith = '<div class="form-group"> <label for="foto">Foto</label><input type="file"  class="form-control" name="photo[]"></div>'
    $('#photos').append(ith)
    numphoto()
  })

  $('.btn-save-service').click(function (e) {
    e.preventDefault()
    var dataform = $('#fr-nuevo-service').serialize()

    $.ajax({
      url: '/admin/servicios',
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        console.log(response)
        window.location.reload()
      }
    })
  })

  $('.btn-servicio-editar').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')

    $.ajax({
      url: '/admin/servicios/' + id + '/edit',
      type: 'GET',
      dataType: 'json',

      success: function (response) {
        subservice(response.registro.service_id)

        $('#fr-edit-service #id').val(response.registro.id)

        $('#fr-edit-service #service').val(response.registro.service_id)
        $('#fr-edit-service #subservice').val(response.registro.subservice_id)
        $('#fr-edit-service #typeservice').val(response.registro.typeservice)
        $('#fr-edit-service #resources').val(response.registro.resources)
        $('#fr-edit-service #picker1').val(response.registro.executiontime)

        $('#fr-edit-service #price').val(response.registro.price)

        $('#modal-editservice').modal('show')
      }
    })
  })

  $('.btn-save-edit-service').click(function (e) {
    e.preventDefault()

    var id = $('#fr-edit-service #id').val()
    var dataform = $('#fr-edit-service').serialize()

    $.ajax({
      url: '/admin/servicios/' + id,
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        window.location.reload()
      }

    })
  })

  $('.btn-servicio-delete').click(function (e) {
    e.preventDefault()
    var r = confirm('Esta seguro de eliminar')
    if (r == true) {
      var id = $(this).data('id')
      var dataform = $('#fr-delete').serialize()
      $.ajax({
        url: '/admin/servicios/' + id,
        type: 'POST',
        data: dataform,
        success: function (response) {
          window.location.reload()
        }
      })
    }
  })

  // usuario estado
  $('.btn-listausuario-desactiva').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')
    var token = $("#fr-listcliente-service input[name='_token']").val()
    var metodo = $("#fr-listcliente-service input[name='_method']").val()
    var dataform = ({ '_method': metodo, '_token': token, 'estado': '1' })
    console.log(dataform)
    $.ajax({
      url: '/admin/estado/' + id,
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        // console.log(response); 
        window.location.reload()
      },
      error: function (err) {
        console.log(err)
      }
    })
  })

  $('.btn-listausuario-activa').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')
    var token = $("#fr-listcliente-service input[name='_token']").val()
    var metodo = $("#fr-listcliente-service input[name='_method']").val()
    var dataform = ({ '_method': metodo, '_token': token, 'estado': '2' })
    $.ajax({
      url: '/admin/estado/' + id,
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        // console.log(response); 
        window.location.reload()
      },
      error: function (err) {
        console.log(err)
      }
    })
  })


  $('.btn-listacliente-activa').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')
    var token = $("#fr-edit-listcliente input[name='_token']").val()
    var metodo = 'PUT'
    var dataform = ({ '_method': metodo, '_token': token, 'estado': '2' })
    $.ajax({
      url: '/admin/listclientes/estado/' + id,
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        // console.log(response); 
        window.location.reload()
      },
      error: function (err) {
        console.log(err)
      }
    })
  })

  $('.btn-accept-job').on('click', function (e) {
    e.preventDefault()

    
    let idcliente = $(this).data('idcliente')
    let idasociado = $(this).data('idasociado')
    let order_id = $(this).data('id')
    let type = $(this).data('type')

    $('#fr-job #order_id').val(order_id)
    $('#fr-job #cliente_id').val(idcliente)
    $('#fr-job #asociado_id').val(idasociado)
    $('#fr-job #type').val(type)


    fetch(`/admin/getfecha/${order_id}`)
      .then(res => res.json())
      .catch(error => console.error('error', error))
      .then(response => {
         
          let fecha = response.fecha.request_date.split(' ');
         
          let gen1 = fecha[0];
          let gen2 = fecha[1];
          let gen3 = fecha[2];

          let thm = gen2.split(':');
          let hora = thm[0];
          let minuto = thm[1];
          
         
        document.getElementById('datepickerget').value =gen1;
       
        $('#horasget').val(hora);
        $('#minutosget').val(minuto);

       
        if(gen3==="AM"){
            document.getElementById('periodo0').value = gen3;
            let periodo= document.getElementById('periodo0');
            periodo.checked = true;
        }else{
            document.getElementById('periodo1').value = gen3;
            let periodo= document.getElementById('periodo1');
            periodo.checked = true;
        } 
       
      })
      $('#modal-job').modal('show')
  })


  $('.btn-save-job').on('click', function (e) {
    e.preventDefault()
    let url = ''
    let idcliente = $('#fr-job #cliente_id').val()
    let idasociado = $('#fr-job #asociado_id').val()
    let respuesta = $('#fr-job #respuesta').val()
    // let duracion  = $("#fr-job #duracion").val()
   

    let precio = $('#fr-job #precio').val()
    let order_id = $('#fr-job #order_id').val()
    var token = $("#fr-job input[name='_token']").val()
    let type = $('#fr-job #type').val()
    var metodo = $('#fr-job #metodo').val()

    let dias = document.getElementById('datepickerget').value;
    let horas = $('#horasget').val();
    let minutos =$('#minutosget').val();
    let periodo = $('input[name=periodosget]:checked').val();


    const datasend = ({'_method': metodo,'_token': token,'order_id': order_id,'type': type,'tiempos':periodo,'cliente_id': idcliente,'asociado_id': idasociado,'respuesta': respuesta,'dias': dias,'horas': horas,'minutos': minutos,'precio': precio})
   
    if (metodo == 'POST') {
      url = `/admin/responder`
    }else {
      url = `/admin/actualizar/${order_id}`
    }
    fetch(url, {
      method: 'POST',
      body: JSON.stringify(datasend),
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(res => res.json())
      .catch(error => console.error('error: ', error))
      .then(response => {
        if(response.sistema){
          alert(response.sistem);
        }
        if(response.rpta=='ok'){
        window.location.reload()
        }
      })
  })

  $('.btn-refuse-job').on('click', function (e) {
    e.preventDefault()

    $('#modal-trash-job').modal('show')
    let idcliente = $(this).data('idcliente')
    let idasociado = $(this).data('idasociado')
    let order_id = $(this).data('id')
    let type = $(this).data('type')

    $('#fr-trash-job #order_id').val(order_id)
    $('#fr-trash-job #cliente_id').val(idcliente)
    $('#fr-trash-job #asociado_id').val(idasociado)
    $('#fr-trash-job #type').val(type)
  })

  $('.btn-save-trash-job').on('click', function (e) {
    e.preventDefault()

    let idcliente = $('#fr-trash-job #cliente_id').val()
    let idasociado = $('#fr-trash-job #asociado_id').val()
    let motivo = $('#fr-trash-job #motivo').val()

    let order_id = $('#fr-trash-job #order_id').val()
    var token = $("#fr-trash-job input[name='_token']").val()
    let type = $('#fr-trash-job #type').val()
    var metodo = 'POST'
    const datasend = ({'_method': metodo,'_token': token,'order_id': order_id,'type': type,'cliente_id': idcliente,'asociado_id': idasociado,'motivo': motivo})

    let url = `/admin/rechazar`

    fetch(url, {
      method: 'POST',
      body: JSON.stringify(datasend),
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(res => res.json())
      .catch(error => console.error('error: ', error))
      .then(response => {
        if(response.sistema){
          alert(response.sistem);
        }
        window.location.reload()
      })
  })

  $('.btn-edit-job').on('click', function (e) {
    e.preventDefault()

    $('#modal-job').modal('show')
    let idcliente = $(this).data('idcliente')
    let idasociado = $(this).data('idasociado')
    let order_id = $(this).data('id')
    let type = $(this).data('type')

    $('#fr-job #order_id').val(order_id)
    $('#fr-job #cliente_id').val(idcliente)
    $('#fr-job #asociado_id').val(idasociado)
    $('#fr-job #type').val(type)
    $('#fr-job #metodo').val('PUT')
    $('#modal-job .modal-title').html('Modificar respuesta')

    let url = `/admin/orden/${order_id}/edit`

    fetch(url).then(res => res.json())
      .catch(error => console.error('error: ', error))
      .then(response => {

        $('#fr-job #respuesta').val(response.res[0].response_detail)
        $('#fr-job #duracion').val(response.res[0].response_days)
        $('#fr-job #precio').val(response.res[0].response_price)
      })
  })

  $('.btn-listacliente-desactiva').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')
    var token = $("#fr-edit-listcliente input[name='_token']").val()
    var metodo = 'PUT'
    var dataform = ({ '_method': metodo, '_token': token, 'estado': '1' })
    $.ajax({
      url: '/admin/listclientes/estado/' + id,
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        // console.log(response); 
        window.location.reload()
      },
      error: function (err) {
        console.log(err)
      }
    })
  })

  // servicios estado

  $('.btn-estado').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')
    var estado = $(this).data('estado')

    var token = $("#fr-datosacceso input[name='_token']").val()
    var metodo = $("#fr-datosacceso input[name='_method']").val()
    var dataform = ({ '_method': metodo, '_token': token, 'estado': estado })
    $.ajax({
      url: '/admin/estadocat/' + id,
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        // console.log(response); 
        // window.location.reload(); 

        actualizahijos(id, estado)
      },
      complete: function () {
        window.location.reload()
      },
      error: function (err) {
        console.log(err)
      }
    })
  })

  $('.btn-sub-estado').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')
    var estado = $(this).data('estado')

    var token = $("#fr-datosacceso input[name='_token']").val()
    var metodo = $("#fr-datosacceso input[name='_method']").val()
    var dataform = ({ '_method': metodo, '_token': token, 'estado': estado })

    $.ajax({
      url: '/admin/estadocat/' + id,
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        window.location.reload()
      }
    })
  })

  // carga profile
  $('#fr-profile').on('submit', (function (e) {
    e.preventDefault()
    var id = $('#fr-profile #admin_id').val()

    $.ajax({
      url: '/admin/profile/' + id,
      type: 'POST',
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function (response) {
        window.location.reload()
      },
      error: function (err) {
        console.log(err)
      }
    })
  }))

  $('.delete-photo').click(function (e) {
    e.preventDefault()
    var r = confirm('Esta seguro de eliminar')
    if (r == true) {
      var id = $(this).data('id')
      var dataform = $('#fr-delete').serialize()
      $.ajax({
        url: '/admin/photo/' + id,
        type: 'POST',
        data: dataform,
        success: function (response) {
          window.location.reload()
        }
      })
    }
  })

  numphoto()
  numstack()

  // setcategory
  $('.btn-save-category').click(function (e) {
    e.preventDefault()

    var dataform = $('#fr-nuevo-category').serialize()

    $.ajax({
      url: '/admin/setcat',
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        window.location.reload()
      }

    })
  })

  $('.btn-editar-category').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')

    $.ajax({
      url: '/admin/servicios/' + id,
      type: 'GET',
      dataType: 'json',

      success: function (response) {
        $('#modal-editservice').modal('show')
        $('#fr-edit-category #nombre').val(response.categorias.name)
        $('#fr-edit-category #parent_id').val(response.categorias.parent_id)
        $('#fr-edit-category #id').val(response.categorias.id)
      }

    })
  })

  $('.btn-save-edit-category').click(function (e) {
    e.preventDefault()
    var id = $('#fr-edit-category #id').val()
    var dataform = $('#fr-edit-category').serialize()

    $.ajax({
      url: '/admin/updatecat/' + id,
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        window.location.reload()
      }

    })
  })

  $('.btn-borrar-category').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')
    var dataform = $('#fr-delete').serialize()

    $.ajax({
      url: '/admin/borrarcat/' + id,
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        window.location.reload()
      }

    })
  })

  $('.btn-save-mdata').click(function (e) {
    e.preventDefault()
    var dataform = $('#fr-datosacceso').serialize()
    var id = $('#fr-datosacceso #id').val()
    $.ajax({
      url: '/admin/entorno/' + id,
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        console.log(response)
      }
    })
  })

  // modal-editlistasociado
  $('.btn-listasociados-editar').click(function (e) {
    e.preventDefault()
    var id = $(this).data('id')

    $.ajax({
      url: '/admin/listasociados/' + id,
      type: 'GET',
      dataType: 'json',
      success: function (response) {
        console.log(response)
        $('#fr-edit-listasociados #id').val(id)
        // $("#fr-edit-listasociados #nombre").val(response.cliente.name)
        $('#fr-edit-listasociados #marca').val(response.socio.tradename)
        $('#fr-edit-listasociados #contacto').val(response.socio.contact)
        $('#fr-edit-listasociados #emailcontacto').val(response.socio.email)
        $('#fr-edit-listasociados #website').val(response.socio.website)
        $('#modal-edit-listasociados').modal('show')
      }
    })
  })

  $('.btn-save-listasociados').click(function (e) {
    e.preventDefault()
    var dataform = $('#fr-edit-listasociados').serialize()
    var id = $('#fr-edit-listasociados #id').val()
    $.ajax({
      url: '/admin/listasociados/' + id,
      type: 'POST',
      dataType: 'json',
      data: dataform,
      success: function (response) {
        console.log(response)
        window.location.reload()
      }
    })
  })

  $('#registro-solicitud').click(function (e) {
    e.preventDefault()
    var comercio = $('#comercio_id').val()
    var dataform = $('#fr-inicio').serialize()
    if (comercio === '') {
      alert('hague click en un pin para añadir al registro su elección')
      return false
    }

    $('#fr-inicio').submit()
  })

  $('.btn-solicitud-cliente-delete').click(function (e) {
    e.preventDefault()

    var r = confirm('Esta seguro de eliminar')
    if (r == true) {
      var id = $(this).data('id')
      var dataform = $('#fr-delete').serialize()
      $.ajax({
        url: '/admin/solicitudes/' + id,
        type: 'POST',
        data: dataform,
        success: function (response) {
          window.location.reload()
        }
      })
    }
  })
// end document
})

function numphoto () {
  var numfotos = $('#photos ul li').length

  if (numfotos > 2) {
    $('.addphoto').hide()
  }
}

function numstack () {
  var stacknum = $('#telefonos .stack').length

  if (stacknum > 2) {
    $('.addphone').hide()
  }
  console.log('evento ' + stacknum)
}

function subservice (id) {
  ghtm = ''
  $.ajax({
    url: '/servicios/' + id,
    type: 'GET',
    dataType: 'json',
    success: function (response) {
      $.each(response.services, function (i, e) {
        ghtm = ghtm + '<option value="' + e.id + '">' + e.name + '</option>'
      })

      console.log(ghtm)
      $('#fr-edit-service #subservice').html(ghtm)
    }

  })
}

function actualizahijos (id, estado) {
  var token = $("#fr-datosacceso input[name='_token']").val()
  var metodo = $("#fr-datosacceso input[name='_method']").val()
  var dataform = ({ '_method': metodo, '_token': token, 'estado': estado })
  $.ajax({
    url: '/admin/estadoparent/' + id,
    type: 'POST',
    dataType: 'json',
    data: dataform,
    success: function (response) {
      return response
    }
  })
}

$(".cambio-estado").click(function(e){
  e.preventDefault();
   let order_id = $(this).data('order');
  $("#modal-estado").modal('show');
  $("#fr-estado #order_id").val(order_id);
});

$(".btn-save-estado").click(function(e){
  let token = $("#fr-estado input[name='_token']").val();
  let estado = $("#fr-estado #estado").val();
  let order_id = $("#fr-estado #order_id").val();

  let dataform = ({ '_method': 'PUT', '_token': token, 'estado': estado });
    let url = `/admin/cambioestado/${order_id}`;
   fetch(url,{
    method: 'POST',
    body: JSON.stringify(dataform),
    headers: {
      'Content-Type': 'application/json'
     }
   }).then(res => res.json())
   .then(error => console.error('error',error))
   .then(response =>{  
           window.location.reload();
   });
});


$(".btn-valorar").click(function(e){
  e.preventDefault();
   let order_id = $(this).data('order');
  $("#modal-valorar").modal('show');
  $("#fr-valorar #order_id").val(order_id);
});

$(".btn-save-valorar").click(function(e){
  e.preventDefault();


  let token = $("#fr-valorar input[name='_token']").val();
  let valorar = $("#fr-valorar #valorar").val();
  let nota = $("#fr-valorar #nota").val();
  let order_id = $("#fr-valorar #order_id").val();

  let dataform = ({ '_method': 'PUT', '_token': token, 'valorar': valorar, 'nota': nota });
    let url = `/admin/setvalorar/${order_id}`;
   fetch(url,{
    method: 'POST',
    body: JSON.stringify(dataform),
    headers: {
      'Content-Type': 'application/json'
     }
   }).then(res => res.json())
   .then(error => console.error('error',error))
   .then(response =>{  
           window.location.reload();
   });


});

