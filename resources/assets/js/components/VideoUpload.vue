<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload</div>

                    <div class="panel-body">
                        <input type="file" name="video" id="video" class="form-control" @change="fileInputChange" v-if="!uploading">

                        <div class="alert alert-danger" v-if="failed"> 
                            something went wrong
                        </div>

                        <div id="video-form" v-if="uploading && !failed">

                            <div class="alert alert-info" v-if="!uploadingComplete"> 
                                your video will be avialable at <a href="$root.url" target="_blank"> {{$root.url}}/video/{{ uid}}.</a>
                            </div>
                            <div class="alert alert-success" v-if="uploadingComplete">
                                upload complete .. video is not processing <a href="/videos"> go to your video</a>
                            </div>

                            <div class="progress">
                                <div class="progress-bar" v-bind:style="{ width: fileprogress + '%'}"></div>    
                            </div>

                            
                            
                                
                            
                            
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" v-model="title">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" v-model="description"></textarea>
                            </div>

                             <div class="form-group">
                                <label for="visibility">Visibility</label>
                                <select class="form-control" v-model="visibility">
                                    <option value="private"> Private</option>
                                    <option value="unlisted"> Unlisted</option>
                                    <option value="public"> Public</option>
                                </select>

                            </div>

                            <span class="help-block pull-right"> {{saveStatus}}</span>
                            <button class="btn btn-default" type="submit" @click.prevent="update"> Save Changes</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data () {

            return {
                uid: null,
                uploading : false,
                uploadingComplete: false,
                failed: false,
                title: 'untitled',
                description: null,
                visibility: 'private',
                saveStatus: null,
                fileprogress: 0,


            } 

        },

        methods: {
            fileInputChange() {
                //console.log(' File Changed !')
                this.uploading = true ;
                this.failed = false ;

                this.file = document.getElementById('video').files[0] ;

                 //store the metadata
                 this.store().then(() => {
                    //upload the video
                    var form = new FormData();

                    form.append('video',this.file);
                    form.append('uid',this.uid);
                    this.$http.post('/upload',form, {

                        progress: (e) => {

                            if (e.lengthComputable) {

                                //console.log(e.loaded + ' ' +  e.total) ;
                                this.updateProgress(e);
                            }
                        }
                    }).then( () => {

                        this.uploadingComplete = true;
                    }, ()=> {
                        this.failed = true ;
                    });

                 }, ()=> {
                    this.failed = true;
                 })
                 
            } ,

            store() {

                return this.$http.post('/videos', {
                    title : this.title,
                    description : this.description ,
                    visibility : this.visibility,
                    extension : this.file.name.split('.').pop(),

                }).then((response) => {

                    //console.log(response.body.data.uid) ;
                    this.uid = response.body.data.uid ;
                }) ;

            },
            update() {
                
                this.saveStatus = 'Saving Chnages.' ;
                return this.$http.put('/videos/' + this.uid , {
                    title : this.title,
                    description : this.description ,
                    visibility : this.visibility,

                }).then((response) => {
                   this.saveStatus = 'Changes Saved. ' ;

                   setTimeout(() => {

                        this.saveStatus = '' ;
                   },3000) ;

                },() => {
                    this.saveStatus = 'Faled to save changes.' ;

                }) ;

            } ,
            updateProgress(e) {
                e.percent = (e.loaded / e.total) * 100 ;
                this.fileprogress = e.percent;

            } ,

        },
        ready() {

        }
      
    }
</script>
