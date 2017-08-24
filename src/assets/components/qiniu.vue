<template>
    <button :id='id'>上传</button>
</template>
<style>

</style>
<script>
    export default{
        data(){
            return{}
        },
        props: ["id", "domain", "token", "url"],
        mounted: function () {
            this.upload()
        },
        methods: {
            upload: function () {
                var self = this;
                Qiniu.uploader({
                    runtimes: 'html5,flash,html4',
                    browse_button: this.id,
                    uptoken: this.token,
                    unique_names: true,
                    get_new_uptoken: false,
                    domain: this.domain,
                    max_file_size: '100mb',
                    max_retries: 3,
                    chunk_size: '4mb',
                    auto_start: true,
                    init: {
                        'FileUploaded': function (up, file, info) {
                            var res = JSON.parse(info);
                            var url = self.domain + res.key;
                            self.$emit('update:url', url);
                        },
                        'Error': function(e){ console.log(e); }
                    }
                });
            }
        }
    }
</script>
