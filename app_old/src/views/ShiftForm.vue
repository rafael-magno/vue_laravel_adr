<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button class="btn pull-left" @click="irParaListagem">Ir para listagem</button>
                <button class="btn pull-right" @click="idturno = 0" v-show="turno.idturno">Novo turno</button>
                <br><br><br>
            </div>
        </div>
        <form action="api/Turno/salvarDados" method="post">
            <div class="row">
                <div class="col-lg-1">Nome</div>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="nome" v-model="turno.nome">
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <input type="button" class="btn btn-primary" @click="salvarDados" value="Salvar">
                </div>
            </div>
            <input type="hidden" name="idturno" v-model="turno.idturno">
        </form>
    </div>
</template>
<script>
  module.exports = {
    data() {
      return {
        idturno: 0,
        pagina: 1,
        totalPaginas: 1,
        totalPorPagina: 20,
        total: 0,
        termoPesquisa: '',
        termoPesquisaInput: '',
        mostrarForm: false,
        turno: {
          idturno: '',
          nome: ''
        }
      }
    },
    methods: {
        irParaListagem() {
            this.mostrarForm = false
            this.idturno = 0
        },
        salvarDados(event) {
          api.post('/shifts', this.turno).then(function () {
            this.mostrarForm = false
            this.refreshTurnos()
          });
        },
        removerDados(idturno) {
            api.delete('/shifts/'+idturno);
        },
        refreshTurnos() {
            this.total++
        }
    }
}
</script>
