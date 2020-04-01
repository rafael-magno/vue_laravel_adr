<template>
    <div>
        <div class="container" v-show="mostrarForm">
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
        <div class="container" v-show="!mostrarForm">
            <div class="row">
                <div class="col-lg-2">
                    <button class="btn btn-primary" @click="mostrarForm = true">Cadastrar turno</button>
                    <br><br>
                </div>
                <div class="col-lg-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Filtrar" v-model="termoPesquisaInput">
                        <span class="input-group-btn">
                            <button class="btn" @click="termoPesquisa = termoPesquisaInput"><i class="fas fa-search"></i></button>
                        </span>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button class="btn" @click="termoPesquisa = ''" v-show="termoPesquisa != ''">Limpar filtro</button>
                </div>
                <div class="col-lg-4">
                    <nav v-show="totalPaginas > 1" class="pull-right">
                      <ul class="pagination justify-content-end">
                        <li class="page-item" :class="{disabled : pagina <= 1}">
                          <a class="page-link" href="javascript:void(0)" @click="pagina = pagina > 1 ? pagina - 1 : 1">Anterior</a>
                        </li>
                        <li class="page-item" :class="{active : pagina == i}" v-for="i in totalPaginas">
                            <a class="page-link" href="javascript:void(0)" @click="pagina = i">{{i}}</a>
                        </li>
                        <li class="page-item" :class="{disabled : pagina >= totalPaginas}">
                          <a class="page-link" href="javascript:void(0)" @click="pagina = pagina < totalPaginas ? pagina + 1 : totalPaginas">Próximo</a>
                        </li>
                      </ul>
                    </nav>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="turno in turnos">
                        <td>{{turno.idturno}}</td>
                        <td>{{turno.nome}}</td>
                        <td><a href="javascript:void(0)" @click="idturno = turno.idturno">Editar</a></td>
                        <td><a href="javascript:void(0)" @click="removerDados(turno.idturno)">Excluir</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
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
    },
    computed: {
        turnos() {
            dadosRequest = {pagina: this.pagina, totalPorPagina: this.totalPorPagina, termoPesquisa: this.termoPesquisa}
            dadosListagem = sendRequest('api/Turno/buscarListagem', dadosRequest)
            this.total = dadosListagem.total
            this.totalPaginas = Math.ceil(this.total / this.totalPorPagina)
            if (this.totalPaginas && this.pagina > this.totalPaginas) {
                this.pagina = this.totalPaginas
                dadosRequest.pagina = this.pagina
                dadosListagem = sendRequest('api/Turno/buscarListagem', dadosRequest)
            }

            return dadosListagem.dados;
        }/*,
        turno() {
            if (this.idturno > 0) {
                this.mostrarForm = true
                return sendRequest('api/Turno/buscarDadosEdicao', {idturno: this.idturno})
            }

            return {
                idturno: '',
                nome: ''
            }
        }*/
    }
}
</script>
