<template>
    <div>
        <h1 class="text-center">agenda de conctactos</h1>
        <hr>
        <!--  // -->
        <!-- Button trigger modal -->
        <button @click="update = false; openModal()" type="button" class="btn btn-primary">
            Nuevo Modal
        </button>

        <!-- Modal -->
        <div class="modal fade " id="exampleModal" tabindex="-1"  :class='{ show: modal }' aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ titleModal }}</h5>
                        <button @click="closeModal()" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="first_name">nombre:
                                <input v-model="contact.first_name" type="text" placeholder="Nombre del conctacto"
                                    id="first_name" class="from-control ">
                            </label>
                            <br>
                    <hr>
                        </div>
                        <div d >
                            <label for="last_name">Apellido:
                                <input v-model="contact.last_name" type="text" placeholder="Nombre del conctacto"
                                    id="last_name" class="from-control ">
                            </label>
                            <br>
                            <hr>
                        </div>
                        <div>
                            <label for="email">Correo Eletronico:
                                <input v-model="contact.email" type="text" placeholder="email del conctacto" id="email"
                                    class="from-control ">
                            </label>
                            <br>
                            <hr>
                        </div>
                        <div>
                            <label for="phone">Telefono:
                                <input v-model="contact.phone" type="text" placeholder="Telefono del conctacto" id="phone"
                                    class="from-control ">
                            </label>
                             <br>
                             <hr>
                        </div>
                        <div>
                            <label for="address ">Domicilio:
                                <input v-model="contact.address" type="text" placeholder="Domicilio del conctacto"
                                    id="address " class="from-control ">
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="closeModal()" type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cerrar</button>
                        <button @click="guardar()" type="button" class="btn btn-dark">guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- // -->
        <table class="table table-striped table-hover">
            <thead class="table-primary table-hover">
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo eletronico</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col" colspan="2" class="text-center">accion </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="contact in contacts " :key="contact.id">
                    <th scope="row">{{ contact.id }}</th>
                    <td>{{ contact.first_name }}</td>
                    <td>{{ contact.last_name }}</td>
                    <td>{{ contact.email }}</td>
                    <td>{{ contact.phone }}</td>
                    <td>{{ contact.address }}</td>
                    <td>
                        <button type="button" class="btn btn-secondary" @click="eliminar(contact.id)">eliminar</button>
                    </td>
                    <td>
                        <button @click="update = true; openModal(contact)" type="button"
                            class="btn btn-info">editar</button>
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
            contact: {
                first_name: '',
                last_name: '',
                email: '',
                phone: '',
                address: ''
            },
            id: 0,
            update: true,
            modal: 0,
            titleModal: '',
            contacts: [],
        }
    },
    methods: {
        async list() {
            const res = await axios.get('contacts')
            this.contacts = res.data;
        },
        async eliminar(id) {
            const res = await axios.delete('/contacts/' + id)
            this.list()
        },
        async guardar() {
            if (this.update) {
                const res = await axios.put('/contacts/' + this.id, this.contact)
            } else {
                const res = await axios.post('/contacts', this.contact)
            }
            this.closeModal();
            this.list();
        },
        openModal(data = {}) {
            this.modal = 1
            if (this.update) {
                this.id = data.id

                this.titleModal = "modificar contacto"
                this.contact.first_name = data.first_name
                this.contact.last_name = data.last_name
                this.contact.email = data.email
                this.contact.phone = data.phone
                this.contact.address = data.address

            }
            else {
                this.id = 0
                this.titleModal = "crear contacto"
                this.contact.first_name = ''
                this.contact.last_name = ''
                this.contact.email = ''
                this.contact.phone = ''
                this.contact.address = ''
            }
        },
        closeModal() {
            this.modal = 0
        },

    },
    created() {
        this.list();
    }
}

</script>
<style>
.show {
    display: list-item;
    opacity: 1;
    background: rgba(red, green, blue, alpha);
}
</style>


