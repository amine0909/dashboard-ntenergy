<template>
    <div class="col-12">
        <div class="container">
            <div class="form-group">
                <label>Rechercher par le status de la résérvation</label>
                <select class="form-control" v-model="selected" @change="filterResult">
                    <option value="">Tout</option>
                    <option value="waiting">En attente</option>
                    <option value="done">Réalisé</option>
                </select><br>
            </div>
        </div><br><br>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Nom client</th>
                    <th>email client</th>
                    <th>Numéro de téléphone</th>
                    <th>Societé</th>
                    <th>Fax</th>
                    <th>Sujet</th>
                    <th>Commentaire</th>
                    <th>Date de résévation</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item) in filtredResult" :key="item.id">
                    <td>{{ item.name_client}}</td>
                    <td>{{ item.email_client}}</td>
                    <td>{{ item.phone_client}}</td>
                    <td v-if="item.societe">{{ item.societe}}</td>
                    <td v-else>Aucune societe</td>
                    <td v-if="item.fax">{{ item.fax}}</td>
                    <td v-else>Aucun fax</td>
                    <td>{{ item.sujet}}</td>
                    <td v-if="item.commentaire">{{ item.commentaire}}</td>
                    <td v-else>Aucun commentaire</td>
                    <td>{{ item.created_at }}</td>
                    <td v-if="item.status=='waiting'">En attente</td>
                    <td v-else>Réalisé</td>
                    <td>
                        <button class="btn btn-success" @click="changeStatus(item)" :disabled="item.status=='done'">Terminé</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>



<script>
    export default {
        data() {
            return {
                allDemandes: [],
                filtredResult: [],
                selected: ''
            }
        },
        created(){
            this.getAllDemandes()
        },
        methods: {
            getAllDemandes(){
                axios.get("http://localhost/chokriProject/public/api/getAllDemandes")
                    .then(res => {
                        this.allDemandes = res.data.data
                        this.filtredResult = res.data.data
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            changeStatus(item){
                axios.post("http://localhost/chokriProject/public/api/change_status", {
                    id: item.id
                })
                    .then(res => {
                        let i=0
                        //console.log(res.data)
                        // console.log(this.filtredResult.filter(it => it.id == item.id))
                        for(i;i<this.allDemandes.length;i++){
                            if(item.id == this.allDemandes[i].id){
                                this.filtredResult.splice(i,1,res.data.data)
                            }
                        }
                    })
                    .catch(err => console.log(err))
            },
            filterResult(){
                let i=0;
                this.filtredResult = []
                if(this.selected == ''){
                    this.filtredResult = this.allDemandes
                }else{
                    while(i<this.allDemandes.length){
                        if(this.allDemandes[i].status === this.selected){
                            this.filtredResult.push(this.allDemandes[i])
                        }
                        i++
                    }
                }
                

            }
        }
    }
</script>

<style scoope>
    body {
  font-family: Helvetica Neue, Arial, sans-serif;
  font-size: 14px;
  color: #444;
}

table {
  border: 2px solid #42b983;
  border-radius: 3px;
  background-color: #fff;
}

th {
  background-color: #42b983;
  color: rgba(255,255,255,0.66);
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

td {
  background-color: #f9f9f9;
}

th, td {
  min-width: 120px;
  padding: 10px 20px;
}

th.active {
  color: #fff;
}

th.active .arrow {
  opacity: 1;
}

.arrow {
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  margin-left: 5px;
  opacity: 0.66;
}

.arrow.asc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-bottom: 4px solid #fff;
}

.arrow.dsc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #fff;
}
</style>