<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> Show perijinan-satu-pintu {{ model.label }}

      <ul class="nav nav-pills card-header-pills pull-right">
        <li class="nav-item">
          <button class="btn btn-primary btn-sm" role="button" @click="back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <vue-form class="form-horizontal form-validation" :state="state" @submit.prevent="onSubmit">
        <div class="form-row">
          <div class="col-md">
            {{ model.label }}
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
             {{ model.description }}
          </div>
        </div>

        <div class="form-row mt-4">
					<div class="col-md">
						{{ model.group_egovernment.label }}
					</div>
				</div>

        <div class="form-row mt-4">
          <div class="col-md">
            {{ model.sector_egovernment.label }}
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
           {{ model.link }}
          </div>
        </div>

      </vue-form>
    </div>
     <div class="card-footer text-muted">
        <div class="row">
          <div class="col-md">
            <b>Username :</b> {{ model.user.name }}
          </div>
          <div class="col-md">
            <div class="col-md text-right">Dibuat : {{ model.created_at }}</div>
            <div class="col-md text-right">Diperbaiki : {{ model.updated_at }}</div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  mounted() {
    axios.get('api/perijinan-satu-pintu/' + this.$route.params.id)
      .then(response => {
        if (response.data.status == true) {
          this.model.label = response.data.perijinan_satu_pintu.label;
          this.model.old_label = response.data.perijinan_satu_pintu.label;
          this.model.description = response.data.perijinan_satu_pintu.description;
          this.model.group_egovernment = response.data.group_egovernment;
          this.model.sector_egovernment = response.data.sector_egovernment;
          this.model.user = response.data.user;
          this.model.link               = response.data.perijinan_satu_pintu.link;
          this.model.created_at = response.data.perijinan_satu_pintu.created_at;
          this.model.updated_at = response.data.perijinan_satu_pintu.updated_at;
        } else {
          alert('Failed');
        }
      })
      .catch(function(response) {
        alert('Break');
        window.location.href = '#/admin/perijinan-satu-pintu';
      }),

      axios.get('api/perijinan-satu-pintu/create')
      .then(response => {
          response.data.group_egovernment.forEach(element => {
            this.group_egovernment.push(element);
          });
      })
      .catch(function(response) {
        alert('Break');
      })
  },
  data() {
    return {
      state: {},
      model: {
        label: "",
        description: "",
        user:"",
        link:"",
        group_egovernment: "",
        sector_egovernment: "",
        created_at:         "",
        updated_at:         ""
      },
      group_egovernment: [],
      sector_egovernment: [],
    }
  },
  methods: {
    onSubmit: function() {
      let app = this;

      if (this.state.$invalid) {
        return;
      } else {
        axios.put('api/perijinan-satu-pintu/' + this.$route.params.id, {
            label: this.model.label,
            description: this.model.description,
            old_label: this.model.old_label,
            group_egovernment_id: this.model.group_egovernment.id,
            sector_egovernment_id: this.model.sector_egovernment.id
          })
          .then(response => {
            if (response.data.status == true) {
              if(response.data.message == 'success'){
                alert(response.data.message);
                app.back();
              }else{
                alert(response.data.message);
              }
            } else {
              alert(response.data.message);
            }
          })
          .catch(function(response) {
            alert('Break ' + response.data.message);
          });
      }
    },
    reset() {
      axios.get('api/perijinan-satu-pintu/' + this.$route.params.id + '/edit')
        .then(response => {
          if (response.data.status == true) {
            this.model.label = response.data.perijinan_satu_pintu.label;
            this.model.description = response.data.perijinan_satu_pintu.description;
          } else {
            alert('Failed');
          }
        })
        .catch(function(response) {
          alert('Break ');
        });
    },
    back() {
      window.location = '#/admin/perijinan-satu-pintu';
    }
  }
}
</script>
