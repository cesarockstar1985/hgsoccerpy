<template>
    <div class="page" v-if="typeof app.sgcVal.direccion !== 'undefined'">
        <div class="title" v-html="app.sgcVal.direccion"></div>
        <div class="col-md-12">
          <div v-if="app.sgcVal.formularios.length">
            <h1>Formularios</h1>
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr v-for="formulario in app.sgcVal.formularios">
                        <td><a v-bind:href="formulario.link"></a>{{formulario.formSubstr}} - {{formulario.nombre}}</td>
                    </tr>
                </tbody>
            </table>
          </div>
          <div v-if="app.sgcVal.instructivos.length">
            <h1>Instructivos</h1>
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr v-for="instructivo in app.sgcVal.instructivos">
                        <td><a v-bind:href="instructivo.link">{{instructivo.formSubstr}} - {{instructivo.nombre}}</a></td>
                    </tr>
                </tbody>
            </table>
          </div>
          <div v-if="app.sgcVal.procedimientos.length">
            <h1>Procedimientos</h1>
            <table class="table table-striped table-bordered">
              <tbody>
                <tr v-for="procedimiento in app.sgcVal.procedimientos">
                  <td><a v-bind:href="procedimiento.link">{{procedimiento.formSubstr}} - {{procedimiento.nombre}}</a></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div v-if="app.sgcVal.solicitudes.length">
            <h1>Solicitudes</h1>
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr v-for="solicitud in app.sgcVal.solicitudes">
                        <td><a v-bind:href="solicitud.link">{{solicitud.formSubstr}} - {{solicitud.nombre}}</a></td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
    </div>
</template>

<script>

  $(".sgcClass").click(function(){

    console.log(router.currentRoute.params.direccion);
    //app.sgcview(router.currentRoute.params.direccion)

  })

    window.setTimeout(function(){
        app.sgcview(router.currentRoute.params.direccion)
    }, 1000 );
</script>