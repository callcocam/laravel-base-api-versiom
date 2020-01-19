<template>
    <div>
        <ckeditor :editor="editor" v-model="value" :config="editorConfig" @input="onChange()" @ready="onReady($event)"></ckeditor>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import '@ckeditor/ckeditor5-build-classic/build/translations/pt-br';
    import AbstractElement from "./AbstractElement";

    export default {
        name: "Editor",
        extends:AbstractElement,
        data() {
            return {
                xhr: null,
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                    language: 'pt-br'
                },
            }
        },
        methods:{
            onReady(eventData) {
                eventData.plugins.get('FileRepository').createUploadAdapter = function (loader) {
                    return {
                        // Starts the upload process.
                        upload() {
                            return loader.file
                                .then( file =>  {

                                    const data = new FormData();

                                    data.append( 'upload', file );

                                   return  Resource.post('/api/admin/editor/upload',data).then(response=>{

                                       return response.body

                                    }).catch((e)=>{

                                       return e
                                    })

                                });
                        },
                        // Aborts the upload process.
                        abort() {}
                    };
                };
            }
        }

    }
</script>
