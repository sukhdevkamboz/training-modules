<style scoped>



</style>


<template>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Question</div>

                    <div class="card-body">
                         <form @submit.prevent="submitForm">

                              <!-- Module Name -->
                              <div class="mb-3">
                                <label for="title" class="form-label">Module Name:</label>
                                <input
                                  type="text"
                                  id="title"
                                  class="form-control"
                                  v-model="title"
                                  placeholder="Enter module name"
                                  required
                                />
                              </div>

                              <!-- Module Description -->
                              <div class="mb-3">
                                <label for="description" class="form-label">Module Description:</label>
                                <textarea
                                  id="description"
                                  class="form-control"
                                  rows="3"
                                  v-model="description"
                                  placeholder="Module description"
                                  required
                                ></textarea>
                              </div>

                              <!-- Question -->
                              <div class="mb-3">
                                <label for="question" class="form-label">Question:</label>
                                <input
                                  type="text"
                                  id="question"
                                  class="form-control"
                                  v-model="question"
                                  placeholder="Enter question"
                                  required
                                />
                              </div>

                              <!-- Radio Selection -->
                              <div class="mb-3">
                                <label class="form-label d-block">Question Type:</label>
                                <div class="form-check">
                                  <input 
                                    type="radio" 
                                    id="option1" 
                                    value="selection" 
                                    v-model="selectedRadio"
                                    class="form-check-input"
                                  >
                                  <label for="option1" class="form-check-label">Selection</label>
                                </div>
                                <div class="form-check">
                                  <input 
                                    type="radio" 
                                    id="option2" 
                                    value="singleChoice" 
                                    v-model="selectedRadio"
                                    class="form-check-input"
                                  >
                                  <label for="option2" class="form-check-label">Single Choice</label>
                                </div>
                              </div>

                              <button type="button" @click="addOption" class="btn btn-primary mt-2">
                                 Add Option
                              </button>

                              <h3>Options</h3>
                              <div v-for="(option, index) in options" :key="index" class="mb-2">
                                  <input
                                    type="text"
                                    v-model="option.text"
                                    placeholder="Option text"
                                    class="form-control"
                                  />
                                  <label>
                                    <input type="checkbox" v-model="option.is_correct" /> Correct
                                  </label>
                                  <button type="button" @click="removeOption(index)" class="btn btn-sm btn-danger">
                                    Remove
                                  </button>
                              </div>

                              <!-- <pre>{{ options }}</pre> -->

                              <button type="submit" class="btn btn-primary w-100">
                                Submit
                              </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from "axios";


export default {
    data() {
        return {
            title: '',
            description: '',
            question: '',
            options: [
                { text: "", is_correct: false }
            ],
            selectedRadio: '',
            //selectedCheckboxes: []
        }
    },
    methods: {
        addOption() {
           this.options.push({ text: "", is_correct: false });
        },
        removeOption(index) {
           this.options.splice(index, 1);
        },
        submitForm() {
          const formData = {
            title: this.title,
            description: this.description,
            question: this.question,
            question_type: this.selectedRadio,
            options: this.options
          };
          
          console.log("Form Submitted:", formData);

          // Example: send to backend using axios
          axios.post('/api/training-modules', formData)
            .then(res => {
                console.log(res.data); // This will show the success message & created data
                alert(res.data.message); // Example: Show success message
                window.location.reload(); // Reload the page
            })
            .catch(err => {
                console.error(err.response.data); // Show error details
            });
        }
    },
    mounted() {
        console.log('Component mounted.');
    }
}
</script>
