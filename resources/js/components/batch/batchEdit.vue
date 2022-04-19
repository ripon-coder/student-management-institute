<template>
 <div>
  <v-skeleton-loader :loading="loading" height="500"  type="list-item-two-line,list-item-two-line,list-item-two-line,list-item-two-line,list-item-two-line,actions">
  <v-form ref="form" v-model="valid" lazy-validation>
    <v-text-field
      v-model="batchNo"
      :counter="50"
      :rules="nameRules"
      label="Batch Number"
      required
    ></v-text-field>

    <v-select
      v-model="coursename"
      :items="courseNameItems"
      item-text="title"
      item-value="id"
      :rules="[(v) => !!v || 'Course Name is required']"
      label="Course Name"
      required
    >
      <template slot="selection" slot-scope="data">
        {{ data.item.title}}, [Discount = ({{Math.round(data.item.discount)}})%]
      </template>
    </v-select>

    <v-select
      v-model="classoneweek"
      :items="classOnWeek"
      :rules="[(v) => !!v || 'Class On Week is required']"
      label="Class On Week"
      required
    ></v-select>

    <v-select
      v-model="duration"
      :items="durationitems"
      :rules="[(v) => !!v || 'Duration is required']"
      label="Duration"
      required
    ></v-select>

    <div class="mt-3">
      <v-menu
        ref="sdate"
        v-model="startdate"
        :close-on-content-click="false"
        :return-value.sync="start_date"
        transition="scale-transition"
        offset-y
        min-width="auto"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="start_date"
            label="Start Date"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker v-model="date" no-title scrollable>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="sdate = false"> Cancel </v-btn>
          <v-btn text color="primary" @click="$refs.sdate.save(date)">
            OK
          </v-btn>
        </v-date-picker>
      </v-menu>
    </div>

    <div class="mt-3">
      <v-menu
        ref="edate"
        v-model="enddate"
        :close-on-content-click="false"
        :return-value.sync="end_date"
        transition="scale-transition"
        offset-y
        min-width="auto"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="end_date"
            label="End Date"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker v-model="date" no-title scrollable>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="edate = false"> Cancel </v-btn>
          <v-btn text color="primary" @click="$refs.edate.save(date)">
            OK
          </v-btn>
        </v-date-picker>
      </v-menu>
    </div>

    <div>
      <v-dialog
        ref="dialog"
        v-model="timemodal"
        :return-value.sync="time"
        persistent
        width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="time"
            label="Class Time"
            prepend-icon="mdi-clock-time-four-outline"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-time-picker v-if="timemodal" v-model="time" full-width>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="timemodal = false"> Cancel </v-btn>
          <v-btn text color="primary" @click="$refs.dialog.save(time)">
            OK
          </v-btn>
        </v-time-picker>
      </v-dialog>
    </div>

    <v-text-field
      v-model="expectedstudent"
      :counter="50"
      :rules="expectedStudentRules"
      label="Expected Student"
      required
    ></v-text-field>

    <v-select
      v-model="mentor"
      :items="mentoritems"
      item-text="name"
      item-value="id"
      :rules="[(v) => !!v || 'Mentor is required']"
      label="Mentor"
      required
    ></v-select>
    <v-select
      v-model="Visibility"
      :items="visibilityitems"
      item-value="id"
      :rules="[(v) => !!v || 'Visibility is required']"
      label="Visibility"
      required
    ></v-select>

    <v-autocomplete
      v-model="classs"
      :items="classitems"
      outlined
      dense
      chips
      small-chips
      label="Class On Day"
      multiple
      class="mt-4"
    ></v-autocomplete>

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4 mt-2"
      @click="validate"
    >
      Save Changes
    </v-btn>
  </v-form>
      <v-overlay :value="overlay">
      <v-progress-circular
        indeterminate
        size="64"
      ></v-progress-circular>
    </v-overlay>
 </v-skeleton-loader>
 

<template>
  <div class="text-center">
    <v-dialog
      v-model="validation"
      width="500"
    >
      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
          Validation Error!
        </v-card-title>

        <v-card-text>
          <ul class="pt-2">
             <li v-for="item in validationError" :key="item.message" class="text-danger">{{item}}</li>
          </ul>
         
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="validation = false"
          >
            I Understood!
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>








   </div>
</template>
<script>
export default {
 props:['batchid'],
  data: () => ({
    valid: true,
    classOnWeek : ['1','2','3','4','5','6','7','8','9'],
    durationitems: ['1 Week','2 Week','3 Week','4 Week','5 Week','6 Week','7 Week','8 Week','9 Week','10 Week'],
    visibilityitems:['On','Off'],
    classitems:['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
    mentoritems:[],
    courseNameItems:[],
    start_date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
      .toISOString()
      .substr(0, 10),
    end_date : new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
      .toISOString()
      .substr(0, 10),

      startdate: false,
      enddate: false,
      time: null,
      timemodal: false,
    date: null,
    nameRules: [
      (v) => !!v || "Batch Number is required",
      (v) => (v && v.length <= 50) || "Batch Number must be less than 50 characters",
    ],
    courseRules: [
      (v) => !!v || "Course is required",
      (v) => (v && v.length <= 50) || "Course must be less than 50 characters",
    ],
    expectedStudentRules: [
      (v) => !!v || "Expected Student is required",
      (v) => (v && v.length <= 50) || "Expected Student must be less than 50 characters",
    ],


    batchNo: "",
    coursename: "",
    classoneweek: "",
    duration: "",
    start_date: "",
    end_date: "",
    time: "",
    expectedstudent: "",
    mentor: "",
    Visibility: "",
    classs: "",

    loading:true,
    overlay :false,

    validationError:[],
    validation:false,



  }),

  methods: {
    validate() {
      this.$refs.form.validate();
      this.datastore();
    },
    getbatch(){
      this.loading = true;
      axios.get("/dashboard/get-batch/"+this.batchid)
      .then(response => {
        // handle success
        this.loading = false;
        this.batchNo = response.data.batch.batchno;
        this.coursename = response.data.batch.course_id;
        this.classoneweek = response.data.batch.classOnWeek;
        this.duration = response.data.batch.duration;
        this.start_date = response.data.batch.startdate;
        this.end_date = response.data.batch.enddate;
        this.time = response.data.batch.classtime;
        this.expectedstudent = response.data.batch.expectedStudent;
        this.mentor = response.data.batch.mentor_id;
        this.Visibility = response.data.batch.status;
        this.classs = response.data.batch.classOnDay;
        console.log(response.data.batch);
      })
      .catch(function (error) {
        // handle error
        this.loading = true;
        console.log(error);
      })
      .then(function () {
        // always executed
      });
    },
    getcourse(){
      axios.get("/dashboard/get-course")
      .then(response => {
        // handle success
        this.loading = false;
        this.courseNameItems = response.data.courses;
        //console.log(response.data.courses);
      })
      .catch(function (error) {
        // handle error
        this.loading = true;
        console.log(error);
      })
      .then(function () {
        // always executed
      });
    },
    getmentor(){
      axios.get("/dashboard/get-mentor")
      .then(response => {
        // handle success
        this.loading = false;
        this.mentoritems = response.data.Mentors;
      })
      .catch(function (error) {
        // handle error
        this.loading = true;
        //console.log(error);
      })
      .then(function () {
        // always executed
      });
    },

    datastore(){
       this.overlay = true;
        axios({
        method: "post",
        url: "/dashboard/update-batch/"+this.batchid,
        dataType: "json",
        data: {
          batchNumber: this.batchNo,
          courseName: this.coursename,
          classOnWeek: this.classoneweek,
          duration: this.duration,
          startDate: this.start_date,
          endDate: this.end_date,
          classTime: this.time,
          expectedStudent: this.expectedstudent,
          mentor: this.mentor,
          visibility: this.Visibility,
          classOnDay: this.classs,
        },
      })
        .then((response) => {
          this.overlay = false;
          window.location.href = "/dashboard/batch";
        })
        .catch((error) => {
           this.overlay = false;
           this.validationError = error.response.data.errors;
          if( this.validationError != ''){
            this.validation = true;
          }
           //console.log([error.response.data.errors]);
        });
    }
  },
  mounted(){
    this.getmentor();
    this.getcourse();
    this.getbatch();

 },

};
</script>