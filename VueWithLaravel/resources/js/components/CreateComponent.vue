<style>
.form_input,
.form_input:hover {
    border: none;
    background-color: lightgray;
    padding: 3px;
}

.form_input:focus-visible {
    outline: none !important;
}

table th {
    padding: 5px;
}

table td {
    border: 1px solid black;
    border-top: none;
    border-collapse: collapse;
}

button {
    border: none;
    border-radius: 10px;
}
</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Create New Student</div>
                    <div class="card-body">
                        <form action="">

                            <div class="form-2">
                                <label for="name" class="label">Name:</label>
                                <input type="text" name="name" class="form_input" v-model="name"
                                    style="width: 100%;border-radius: 10px;">
                            </div>

                            <div class="form-2">
                                <label for="name" class="label">Address:</label>
                                <input type="text" v-model="address" class="form_input" name="address"
                                    style="width: 100%;border-radius: 10px;">
                            </div>

                            <div class="form-2">
                                <label for="name" class="label">Email:</label>
                                <input type="email" v-model="email" name="email" class="form_input"
                                    style="width: 100%;border-radius: 10px;">
                            </div>

                            <div class="form-2">
                                <label for="name" class="phone">Phone:</label>
                                <input type="text" v-model="phone" class="form_input" name="phone"
                                    style="width: 100%;border-radius: 10px;">
                            </div>
                            <div class="form-2">
                                <label for="name" class="label"></label>
                                <input type="button" value="SAVE" @click.prevent="saveStudent"
                                    style="width: 100%;border-radius: 10px;background-color: aquamarine; border: none;padding: 10px; font-weight: 900;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Get All Details Of Students</div>
                    <div class="card-body">
                        <div class="userTable" style="overflow: auto;max-height: 250px;">
                            <table border="1" width="100%">
                                <thead style="background:#727272;text-align: center;color: white;">
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th colspan="2">Actions</th>

                                </thead>
                                <tbody style="text-align: center;">
                                    <tr v-for="(student, index) in this.students" :key="index">
                                        <td>{{ student.id }}</td>
                                        <td>{{ student.name }}</td>
                                        <td>{{ student.address }}</td>
                                        <td>{{ student.email }}</td>
                                        <td>{{ student.phone }}</td>
                                        <td colspan="2"> <!-- Button trigger modal -->
                                            <button class=" btn-primary" data-toggle="modal"
                                                @click="editStudent(student.id)" data-target="#exampleModal">
                                                EDIT
                                            </button> || <button @click="deleteStudent(student.id)"
                                                style="background-color: red;">DELETE</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- EDIT modal for student table -->


        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" ref="hideModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Student Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">

                            <div class="form-2">
                                <label for="name" class="label">Name:</label>
                                <input type="text" name="name" class="form_input" v-model="editname"
                                    style="width: 100%;border-radius: 10px;">
                            </div>

                            <div class="form-2">
                                <label for="name" class="label">Address:</label>
                                <input type="text" v-model="editaddress" class="form_input" name="address"
                                    style="width: 100%;border-radius: 10px;">
                            </div>

                            <div class="form-2">
                                <label for="name" class="label">Email:</label>
                                <input type="email" v-model="editemail" name="email" class="form_input"
                                    style="width: 100%;border-radius: 10px;">
                            </div>

                            <div class="form-2">
                                <label for="name" class="phone">Phone:</label>
                                <input type="text" v-model="editphone" class="form_input" name="phone"
                                    style="width: 100%;border-radius: 10px;">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="" data-dismiss="modal">CLOSE</button>
                        <button type="button" class="btn" @click="updateStudent"
                            style="background-color: aquamarine;">SAVE</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of modal -->
    </div>
</template>

<script>
// import { Modal } from 'bootstrap-vue';
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
});
export default {
    data() {
        return {
            id: '',
            name: "",
            address: "",
            email: "",
            phone: "",
            editname: "",
            editaddress: "",
            editemail: "",
            editphone: "",
            students: []
        }
    },
    methods: {
        saveStudent() {
            axios.post('save_student', {
                name: this.name,
                address: this.address,
                email: this.email,
                phone: this.phone,

            })
                .then(response => {
                    this.getAllStudent();
                    this.resetForm();
                });

        },
        resetForm() {
            this.name = '';
            this.address = '';
            this.email = '';
            this.phone = '';
        },
        refreshPage() {
            window.location.reload(); // Reload the page
        },

        getAllStudent() {
            axios.get('all_students').then(response => {
                this.students = response.data;
                // console.log(this.students);
            }, error => {
                alert(error.responseJSON.message);
            })
        },

        editStudent(id) {
            axios.get('edit_student/' + id).then(response => {
                // console.log(response);
                this.id = response.data.id;
                this.editname = response.data.name;
                this.editaddress = response.data.address;
                this.editemail = response.data.email;
                this.editphone = response.data.phone;
            }, error => {
                alert(error.responseJSON.message);
            })
        },
        updateStudent() {
            const id = this.id;
            axios.post("updateStudent/" + id, {
                name: this.editname,
                address: this.editaddress,
                email: this.editemail,
                phone: this.editphone
            }).then(response => {
                $('.close').trigger("click");
                this.refreshPage();
            }, error => {
                alert(error.responseJSON.message);
            })
        },
        deleteStudent(id) {
            axios.get('deleteStudent/' + id).then(response => { 
                this.refreshPage();
            }, 
            error => { alert(error.responseJSON.message) });
        }
    },
    mounted() {
        // require('bootstrap');
        this.getAllStudent();
    }
}
</script>
