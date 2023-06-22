<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Api consume EasyBroker | Properties </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container" id="app">
        <h2>Lista de Propiedades</h2>

        <div class="row mt-4">
            <button v-if="pagination.next_page != null" class="btn btn-primary" @click="nextPage">Siguiente página ---> </button>

            <button v-if="pagination.page > 1" class="btn btn-primary mt-2" @click="antPage"><---- Anterior</button>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-md-12" v-if="loading">
                <div class="card-body">
                    Cargando propiedades ...
                </div>
            </div>

            <div v-if="!loading" class="col-12 col-md-4" v-for="(property, index) in properties" :key="index">
                <div class="card mb-3">
                    <img :src="property.title_image_thumb" class="card-img-top" alt="Image">
                    <div class="card-body">
                        <h5 class="card-title">{{property.title}}</h5>
                        <p class="card-text">{{property.location}}</p>
                        <p class="card-text"><small class="text-body-secondary">
                            {{property.operations[0].formatted_amount}}
                        </small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>

        const { createApp } = Vue

        createApp({
            data() {
                return {
                    loading : true,
                    properties: [],
                    pagination : {
                        limit : 20,
                        next_page : null,
                        page : 1,
                        total : 0
                    }
                }
            },
            mounted(){
                this.getListAllProperties()
            },
            methods : {

                async getListAllProperties(){

                    this.loading = true;

                    let request = await fetch('api/EasyBrokerAPI.php?listAllProperties=all&page=' + this.pagination.page, {
                        method: 'GET'
                    });

                    let response = await request.json();

                    this.loading = false;

                    this.properties = response.data.content;
                    this.pagination = response.data.pagination;

                },
                nextPage(){
                    this.pagination.page++;
                    this.getListAllProperties(this.page);
                },
                antPage(){

                    this.pagination.page--;
                    this.getListAllProperties(this.page);

                }


            }
        }).mount('#app')

       

    </script>
</body>

</html>