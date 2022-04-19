<template>
  <div class="app-card app-card-orders-table shadow-sm mb-5">
    <div class="app-card-body">
      <v-skeleton-loader
        :loading="loading"
        height="500"
        type="list-item-two-line,list-item-two-line,list-item-two-line,list-item-two-line,list-item-two-line,actions"
      >
        <div v-if="students.length > 0" class="table-responsive">
          <table class="table app-table-hover mb-0 text-left">
            <thead>
              <tr>
                <th class="cell">CRO</th>
                <th class="cell">Reg.No</th>
                <th class="cell">Name</th>
                <th class="cell">Mobile</th>
                <th class="cell">Batch</th>
                <th class="cell">Course</th>
                <th class="cell">Mentor</th>
                <th class="cell">Class</th>
                <th class="cell">Amount</th>
                <th class="cell">Status</th>
                <th class="cell">Payment</th>
                <th class="cell">Edit</th>
                <th class="cell">View</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="index in students" :key="index.id">
                  <td class="cell">{{ index.referenced.name }}</td>
                <td class="cell">{{ index.id }}</td>
                <td class="cell">{{ index.name }}</td>
                <td class="cell">{{ index.mobile }}</td>
                <td v-if="index.batch" class="cell">
                  {{ index.batch.batchno }}
                </td>
                <td v-else class="cell">---</td>
                <td class="cell">{{ index.course.title }}</td>
                <td v-if="index.batch" class="cell">
                  {{ index.batch.mentor_name }}
                </td>
                <td v-else class="cell">---</td>
                <td v-if="index.batch" class="cell">
                  <li v-for="onday in index.batch.classOnDay" :key="onday">{{onday}}</li>
                </td>
                <td v-else class="cell">---</td>
                <td class="cell">
                  {{ index.course.discount_price }} Tk <br />
                  Discount: {{ Math.round(index.course.discount) }}%
                </td>




                  <td v-if=" Number(index.payment_sum_amount) >= Number(index.course.discount_price)" class="cell"><a class=" text-white btn-sm app-btn-primary" href="#">FullyPaid</a></td>
                  <td v-else-if="Number(index.payment_sum_amount) > 1" class="cell"><a class=" btn-sm app-btn bg-warning text-white" href="#">Due</a></td>
                  <td v-else class="cell"><a class=" btn-sm app-btn bg-danger text-white" href="#">Un-Paid</a></td> 

                
                

                <td class="cell">
                  <a
                    class="btn-sm app-btn-secondary"
                    @click="payment(index.id)"
                    href="#"
                    >Payment</a
                  >
                </td>
                <td class="cell">
                  <a
                    @click="studentEdit(index.id)"
                    class="text-white btn-sm app-btn-primary"
                    href="#"
                    >Edit</a
                  >
                </td>
                <td class="cell">
                  <a
                    class="btn-sm app-btn-secondary"
                    @click="viewdetails(index.id)"
                    href="#"
                    >View</a
                  >
                </td>
              </tr>
            </tbody>
          </table>
          <br />
        </div>
        <div v-else>
          <v-alert type="error">Sorry! Data Not Found! </v-alert>
        </div>
      </v-skeleton-loader>
    </div>

    <v-snackbar v-model="snackbar">
      Student Update Successfully!
      <template v-slot:action="{ attrs }">
        <v-btn color="red" text v-bind="attrs" @click="snackbar = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>

    <!-- Student details Start -->
    <template>
      <v-row justify="center">
        <v-dialog v-model="viewdetails_modal" persistent max-width="600px">
          <v-card>
            <v-card-title>
              <span class="text-h5">Student Profile</span>
            </v-card-title>
            <v-card-text>
              <table class="table table-bordered table-primary">
                <tbody>
                  <tr>
                    <td>Registraion No</td>
                    <td>{{ studentprofile.id }}</td>
                  </tr>
                  <tr>
                    <td>Name</td>
                    <td>{{ studentprofile.name }}</td>
                  </tr>
                  <tr>
                    <td>Mobile</td>
                    <td>{{ studentprofile.mobile }}</td>
                  </tr>
                  <tr>
                    <td>Father Name</td>
                    <td>{{ studentprofile.fathername }}</td>
                  </tr>
                  <tr>
                    <td>Mother Name</td>
                    <td>{{ studentprofile.mothername }}</td>
                  </tr>
                  <tr>
                    <td>Gender</td>
                    <td>{{ studentprofile.gender }}</td>
                  </tr>
                  <tr>
                    <td>Date of birth</td>
                    <td>{{ studentprofile.dateofbirth }}</td>
                  </tr>
                  <tr>
                    <td>Facebook Name</td>
                    <td>{{ studentprofile.fbname }}</td>
                  </tr>
                  <tr>
                    <td>Qualification</td>
                    <td>{{ studentprofile.education }}</td>
                  </tr>
                  <tr>
                    <td>Address</td>
                    <td>{{ studentprofile.address }}</td>
                  </tr>
                  <tr>
                    <td>Created Date</td>
                    <td>{{ studentprofile.created_at }}</td>
                  </tr>
                </tbody>
              </table>
              <v-overlay :value="overlay">
                <v-progress-circular
                  indeterminate
                  size="64"
                ></v-progress-circular>
              </v-overlay>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="viewdetails_modal = false"
              >
                Close
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </template>
    <!-- Student Details End -->
    <!-- Student Edit Start -->
    <template>
      <v-row justify="center">
        <v-dialog v-model="viewEdit_modal" persistent max-width="600px">
          <v-card>
            <v-card-title>
              <span class="text-h5">Student Profile</span>
            </v-card-title>
            <v-card-text>
              <div>
                <label class="form-label">Batch Select</label>
                <select v-model="batch" class="form-select">
                  <option
                    v-for="index in allbatch"
                    :key="index.id"
                    :value="index.id"
                  >
                    {{ index.batchno }}
                  </option>
                </select>
              </div>
              <hr />
              <div class="row">
                <div class="col-6">
                  <label class="form-label">Name</label>
                  <input type="text" v-model="name" class="form-control" />
                </div>
                <div class="col-6">
                  <label class="form-label">Mobile</label>
                  <input type="text" v-model="mobile" class="form-control" />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label class="form-label">Father Name</label>
                  <input type="text" v-model="father" class="form-control" />
                </div>
                <div class="col-6">
                  <label class="form-label">Mother Name</label>
                  <input type="text" v-model="mother" class="form-control" />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label class="form-label">Date Of Birth</label>
                  <input
                    type="text"
                    v-model="dateofbirth"
                    class="form-control"
                  />
                </div>
                <div class="col-6">
                  <label class="form-label">Address</label>
                  <input type="text" v-model="address" class="form-control" />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label class="form-label">Facebook Name</label>
                  <input type="text" v-model="fbname" class="form-control" />
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label class="form-label">Gender</label>
                  <select class="form-select" v-model="gender">
                    <option v-for="index in genderitems" :key="index.id">
                      {{ index }}
                    </option>
                  </select>
                </div>
                <div class="col-6">
                  <label class="form-label">Course</label>
                  <select v-model="course" class="form-select">
                    <option
                      v-for="index in coursesss"
                      :key="index.id"
                      :value="index.id"
                    >
                      {{ index.title }} -- Discount:
                      {{ Math.round(index.discount) }}% @
                      {{ index.discount_price }} Tk
                    </option>
                  </select>
                </div>
              </div>
              <v-overlay :value="overlay">
                <v-progress-circular
                  indeterminate
                  size="64"
                ></v-progress-circular>
              </v-overlay>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="viewEdit_modal = false">
                Close
              </v-btn>
              <v-btn color="blue darken-1" text @click="editSave"> Save </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </template>
    <!-- Student Edit End -->

    <!-- Payement -->

    <template>
      <v-row justify="center">
        <v-dialog
          v-model="payment_dialog"
          fullscreen
          hide-overlay
          transition="dialog-bottom-transition"
        >
          <v-card>
            <v-toolbar dark color="primary">
              <v-btn icon dark @click="payment_dialog = false">
                <v-icon>mdi-close</v-icon>
              </v-btn>
              <v-toolbar-title>Payment</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-toolbar-items>
                <v-btn dark text @click="payment_dialog = false"> Invoice </v-btn>
              </v-toolbar-items>
            </v-toolbar>
            <v-list three-line subheader> </v-list>
            <div class="container-fluid">
              <div class="pt-4">
                <div v-if="invoice_get" class="row">
                  <div class="col-md-6">
                    <div class="" style="width: 40rem">
                      <div class="card-body">
                        <table class="table table-bordered">
                          <tbody>
                            <tr v-if="invoice_get.student">
                              <th scope="row">Name</th>
                              <td>{{ invoice_get.student["name"] }}</td>
                            </tr>
                            <tr v-if="invoice_get.student">
                              <th scope="row">Registraion Number</th>
                              <td>{{ invoice_get.student["id"] }}</td>
                            </tr>
                            <tr v-if="invoice_get.student">
                              <th scope="row">Course</th>
                              <td>{{ invoice_get.student.course.title }}</td>
                            </tr>
                            <tr v-if="invoice_get.student">
                              <th scope="row">Batch</th>
                              <td colspan="2">
                                {{ invoice_get.student.batch.batchno }}
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="" style="width: 40rem">
                      <div class="card-body">
                        <table class="table table-bordered">
                          <tbody>
                            <tr v-if="invoice_get">
                              <th scope="row">Invoice No.</th>
                              <td>{{ invoice_get.id }}</td>
                            </tr>
                            <tr v-if="invoice_get.student">
                              <th scope="row">Course Fee</th>
                              <td>
                                {{ invoice_get.student.course.discount_price }}
                                TK
                              </td>
                            </tr>
                            <tr v-if="invoice_get">
                              <th scope="row">Paid</th>
                              <td v-if="invoice_get.paid_sum">
                                <mark>{{ invoice_get.paid_sum }} TK</mark>
                              </td>
                              <td v-else>0 TK</td>
                            </tr>
                            <tr v-if="invoice_get.student">
                              <th scope="row">UnPaid</th>
                              <td v-if="invoice_get.paid_sum">
                                <mark>{{
                                  invoice_get.student.course.discount_price -
                                  invoice_get.paid_sum
                                }}
                                TK </mark>
                              </td>
                              <td v-else>
                                <mark>{{ invoice_get.student.course.discount_price }}
                                TK</mark>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div v-else>
                  <v-alert
                    border="top"
                    colored-border
                    type="info"
                    elevation="2"
                  >
                    Invoice Not Found ! <b>Create Invoice</b>
                    <v-btn
                      @click="createinvoice"
                      class="mx-2"
                      fab
                      dark
                      color="indigo"
                      small
                    >
                      <v-icon dark> mdi-plus </v-icon>
                    </v-btn>
                  </v-alert>
                </div>
                <v-overlay :value="paymentload">
                  <v-progress-circular
                    indeterminate
                    size="64"
                  ></v-progress-circular>
                </v-overlay>

                <div v-if="invoice_get" class="d-flex justify-content-center">
                  <div class="card" style="width: 40rem">
                    <div class="card-body">
                      <h6 class="card-subtitle mb-2 text-muted text-center">
                        Create Payment
                      </h6>
                      <div class="mb-3">
                        <label  class="form-label">Amount*</label>
                        <input v-model="amount" type="text" class="form-control"/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Method*</label>
                        <select v-model="method" class="form-select">
                          <option value="Bkash">Bkash</option>
                          <option value="Nagad">Nagad</option>
                          <option value="Cash">Cash</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label  class="form-label">Note</label>
                        <textarea v-model="note" class="form-control" cols="30" rows="10"></textarea>
                      </div>
                      <button @click="createpayment(invoice_get.id)" type="button" class="btn btn-primary btn-sm text-white">Add</button>
                    </div>
                      <v-snackbar v-model="paymentsuccessfull">
                      Create Payment Successfully!
                      <template v-slot:action="{ attrs }">
                        <v-btn color="red" text v-bind="attrs" @click="paymentsuccessfull = false">
                          Close
                        </v-btn>
                      </template>
                    </v-snackbar>
                  </div>
                </div>

              <div class="container">
                <div v-if="paymentall.length>0">
                <table class="table table-bordered">
                  <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Method</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Note</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="index in paymentall" :key="index.id">
                        <th scope="row">{{index.id}}</th>
                        <td>{{index.amount}} &#2547;</td>
                        <td>{{index.method}}</td>
                        <td>{{index.created_at}}</td>
                        <td>{{index.note}}</td>
                        <td><button @click="deletepayment(index.id)" type="button" class="btn btn-danger btn-sm text-white">Del</button></td>
                      </tr>
                    </tbody>
                </table>
                </div>
                <div v-else>
                  <v-alert
                    dense
                    border="left"
                    type="warning"
                  >
                    Payment Not Found!
                  </v-alert>
                </div>
              </div>

              </div>
            </div>
          </v-card>
        </v-dialog>
      </v-row>
    </template>
  </div>
</template>




    <!-- End Payment -->


  </div>
</template>
  </div>
  
</template>
<script>

export default {
  props:{
      batch_st_id:String
      },
  data: () => ({
    viewdetails_modal: false,
    students: [],
    loading: false,
    overlay: false,
    studentprofile: [],
    viewEdit_modal: false,
    allbatch: [],
    batch: "",
    student_id: "",

    snackbar: false,


    // student edit model
    name: "",
    mobile: "",
    father: "",
    mother: "",
    dateofbirth: "",
    address: "",
    fbname: "",
    gender: "",
    course: "",
    genderitems: ["Male", "Female"],
    coursesss: [],

    // Payment
    payment_dialog: false,
    paymentload: false,
    stid_payment: "",
    invoice_get: [],
    paymentall:[],
    // Create Payment
    amount:'',
    method:'',
    note:'', 
    paymentsuccessfull:false,
  
  }),
  mounted() {
    console.log(this.batch_st_id);
    this.getstudent();
  },
  methods: {
    getstudent() {
      axios
        .get("/dashboard/get-student-by-batch/" + this.batch_st_id)
        .then((response) => {
          this.students = response.data;
          console.log(response.data);
        })
        .catch(function (error) {
          // handle error
          //this.loading = true;
          console.log(error);
        })
        .then(function () {
          // always executed
        });
    },
    onPageChange() {
      this.getstudent();
    },
    viewdetails(id) {
      this.viewdetails_modal = true;
      this.overlay = true;
      axios
        .get("/dashboard/get-student-profile-by-cro/" + id)
        .then((response) => {
          this.studentprofile = response.data.student_profile;
          this.overlay = false;
        })
        .catch(function (error) {
          // handle error
          //this.loading = true;
          console.log(error);
        })
        .then(function () {
          // always executed
        });
    },
    studentEdit(id) {
      this.viewEdit_modal = true;
      this.overlay = true;
      this.student_id = id;
      axios
        .get("/dashboard/get-all-batch")
        .then((response) => {
          this.allbatch = response.data;
          this.overlay = false;
        })
        .catch(function (error) {
          // handle error
          //this.loading = true;
          console.log(error);
        })
        .then(function () {
          // always executed
        });

      // Get student
      this.overlay = true;
      axios
        .get("/dashboard/get-student-profile-by-cro/" + id)
        .then((response) => {
          this.name = response.data.student_profile.name;
          this.mobile = response.data.student_profile.mobile;
          this.father = response.data.student_profile.fathername;
          this.mother = response.data.student_profile.mothername;
          this.dateofbirth = response.data.student_profile.dateofbirth;
          this.address = response.data.student_profile.address;
          this.fbname = response.data.student_profile.fbname;
          this.gender = response.data.student_profile.gender;
          this.course = response.data.student_profile.course_id;
          this.batch = response.data.student_profile.batch_id;
          this.overlay = false;
        });

      // Get course
      this.overlay = true;
      axios.get("/dashboard/get-course").then((response) => {
        this.coursesss = response.data.courses;
        this.overlay = false;
      });
    },
    editSave() {
      this.loading = true;
      axios({
        method: "post",
        url: "/dashboard/student-update/" + this.student_id,
        dataType: "json",
        data: {
          name: this.name,
          fathername: this.father,
          mothername: this.mother,
          course_id: this.course,
          fbname: this.fbname,
          address: this.address,
          mobile: this.mobile,
          dateofbirth: this.dateofbirth,
          gender: this.gender,
        },
      })
        .then((response) => {
          //this.overlay = false;
          this.getstudent();
          (this.snackbar = true), (this.loading = false);
        })
        .catch((error) => {
          this.loading = false;
        });

      this.viewEdit_modal = false;
    },
    payment(student_id) {
      this.stid_payment = student_id;
      this.payment_dialog = true;
      this.paymentload = true;
      axios.get("/dashboard/invoice-get/" + student_id).then((response) => {
        this.invoice_get = response.data.invoice;
        this.paymentload = false;
      });
     axios.get("/dashboard/get-payment/" + student_id).then((response) => {
        this.paymentall = response.data;
        //console.log(response);
      });
    },
    createinvoice() {
      console.log(this.stid_payment);
      axios({
        method: "post",
        url: "/dashboard/invoice-create/" + this.stid_payment,
        dataType: "json",
      }).then((response) => {
        this.payment(this.stid_payment);
        this.paymentsuccessfull = true;
        this.getstudent();

      });
    },
    createpayment(invoiceid){
      this.paymentload = true;
       axios({
        method: "post",
        url: "/dashboard/create-payment",
        dataType: "json",
        data: {
          invoiceid: invoiceid,
          studentid: this.stid_payment,
          amount: this.amount,
          method: this.method,
          note: this.note,
        },
      }).then((response) => {
        this.payment(this.stid_payment);
        this.getstudent();
        this.amount = '';
        this.method = '';
        this.note = '';
        this.paymentload = false;
        this.paymentsuccessfull = true;
      }).catch((error) => {
          console.log(error);
        });

    },
    deletepayment(paymentid){
      this.paymentload = true;
      axios({
        method: "post",
        url: "/dashboard/delete-payment/" + paymentid,
        dataType: "json",
      }).then((response) => {
        this.payment(this.stid_payment);
        //this.paymentsuccessfull = true;
        this.getstudent();
        this.paymentload = false;

      });
    }

  },
  watch: {
    batch(event) {
      this.overlay = true;
      axios({
        method: "post",
        url: "/dashboard/update-bach-by-cro/" + this.student_id,
        dataType: "json",
        data: {
          batchid: event,
          studentid: this.student_id,
        },
      })
        .then((response) => {
          this.overlay = false;
          this.getstudent();
        })
        .catch((error) => {
          this.overlay = false;
        });
    },
  },
};
</script>
