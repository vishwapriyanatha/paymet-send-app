<template>
    <v-app>
        <v-btn small color="primary" @click="sendPayment">Send Payment</v-btn>
        <v-simple-table>
            <template v-slot:default>
                <thead>
                <tr>
                    <th class="text-left">
                        Sender Name
                    </th>
                    <th class="text-left">
                        Amount
                    </th>
                    <th class="text-left">
                        Claim
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="item in desserts"
                    :key="item.name">
                    <td>{{ item.sender_name }}</td>
                    <td>{{ item.amount }}</td>
                    <td>
                        <span v-if="item.claimed">Claimed</span>
                        <span v-else>
                            <button type="button" class="btn btn-sm btn-info"
                                    @click="claimAmount(item.id)">Claim</button>
                        </span>
                    </td>
                </tr>
                </tbody>
            </template>
        </v-simple-table>
        <div class="modal" tabindex="-1" role="dialog" id="send_payment">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <ValidationObserver ref="observer" tag="form" v-slot="{handleSubmit}">
                        <form @submit.prevent="handleSubmit(submitForm)">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Email*</label>
                                    <ValidationProvider rules="required|email" name="Email" v-slot="{ errors }">
                                        <input type="text" v-model="formData.email" class="form-control"/>
                                        <span class="error-font">{{ errors[0] }}</span>
                                    </ValidationProvider>
                                </div>

                                <div class="form-group">
                                    <label>Amount $*</label>
                                    <ValidationProvider rules="required|decimal_amount" name="Amount"
                                                        v-slot="{ errors }">
                                        <input type="text" v-model="formData.amount" class="form-control"/>
                                        <span class="error-font">{{ errors[0] }}</span>
                                    </ValidationProvider>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <v-col class="text-right" cols="12" sm="4">
                                    <div class="my-2">
                                        <v-btn small color="primary" type="submit">
                                            Submit
                                        </v-btn>
                                    </div>
                                </v-col>
                            </div>
                        </form>
                    </ValidationObserver>
                </div>
            </div>
        </div>
    </v-app>

</template>

<script>
    import swal from 'sweetalert2';

    export default {
        name: "Payment",
        data() {
            return {
                desserts: [],
                formData: {
                    email: '',
                    amount: ''
                }
            }
        },
        methods: {
            claimAmount(id) {
                let self = this;
                axios.get('/claim/' + id).then(function () {
                    self.getTableData()
                })
            },
            getTableData() {
                let self = this;
                axios.get('/payment').then(function (request) {
                    self.desserts = request.data.data
                });
            },
            resetFrom() {
                this.formData.email = this.formData.amount = '';
            },
            sendPayment() {
                this.$refs.observer.reset();
                this.resetFrom();
                $('#send_payment').modal('show')
            },
            submitForm() {
                let self = this;
                swal.fire({
                    title: "Are you sure?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((submitAmount) => {
                    if (submitAmount.isConfirmed) {
                        axios.post('/payment', self.formData);
                        $('#send_payment').modal('hide')
                    }
                });
            },
        },
        beforeMount() {
            this.getTableData();
        }
    }
</script>

<style scoped>

</style>
