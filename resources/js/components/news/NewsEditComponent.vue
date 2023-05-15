<template>
    <div class="container">
        <div class="title">
            <h3 class="title-text">お知らせ編集</h3>
        </div>
        <div class="edit-area">
            <form method="GET" action="/news/save" enctype="multipart/form-data">
                <input type="hidden" name="id" v-model="id">
                <input type="hidden" name="_token" v-model="csrf">
                <input type="hidden" name="referer" v-model="referer">
                <input type="hidden" name="created_at" id="created_at" v-model="created_at">
                <input type="hidden" name="updated_at" id="updated_at" v-model="updated_at">
                <div class="title">
                    <label class="letter-title">タイトル:</label>
                    <input type="text" name="title" id="title" class="form-area" v-model="title">
                    <strong class="error" v-for="(value,index) in this.errors.title" :key="index">{{ value }}</strong>
                </div>
                <div class="description">
                    <label class="letter">説明:</label>
                    <textarea cols="50" rows="5" type="text" name="description" id="description" class="form-area" v-model="description"></textarea>
                    <strong class="error" v-for="(value,index) in this.errors.description" :key="index">{{ value }}</strong>
                </div>
                <div class="image">
                    <label class="letter">画像:</label>
                    <input type="file" name="image" id="image" class="form-area">
                    <strong class="error" v-for="(value,index) in this.errors.image" :key="index">{{ value }}</strong>
                    <img :src="image">
                </div>
                <div class="started_at">
                    <label class="letter-date">掲載開始日時:</label>
                    <input type="datetime-local" name="started_at" id="started_at" class="form-area" v-model="started_at">
                    <strong class="error" v-for="(value,index) in this.errors.started_at" :key="index">{{ value }}</strong>
                </div>
                <div class="ended_at">
                    <label class="letter-date">掲載終了日時:</label>
                    <input type="datetime-local" name="ended_at" id="ended_at" class="form-area" v-model="ended_at">
                    <strong class="error" v-for="(value,index) in this.errors.ended_at" :key="index">{{ value }}</strong>
                </div>
                <div class="edit-btn">
                    <button v-if="news" class="btn btn-warning" style="width:200px;" type="button">編集</button>
                    <button v-else class="btn btn-warning" style="width:200px;" type="button">作成</button> 
                </div>
            </form>
            <div class="edit-btn">
                <button @click="back()" class="btn btn-secondary" style="width:200px; margin-top:20px;" type="button">戻る</button> 
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:["news", "old", "errors"],
    data: () => ({
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        referer: document.referrer,
        id: null,
        created_at: null,
        updated_at: null,
        title: null,
        description,
        image,
        started_at,
        ended_at,
    }),
    mounted() {
        console.log(this.news)
        console.log(this.csrf)
    },
    methods: {
        isEmpty: function(obj) {
            for(let i in obj) {
                return false;
            }
            return true
        },
        setValidation: function() {
            if(!this.isEmpty(this.old)) {
                this.id = this.old.id
                this.title = this.old.title
                this.description = this.old.description
                this.started_at = this.old.started_at
                this.ended_at = this.old.ended_at
            }else {
                if(!this.isEmpty(this.news)) {
                    this.id = this.news.id
                    this.title = this.news.title
                    this.description = this.news.description
                    this.started_at = this.news.started_at
                    this.ended_at = this.news.ended_at
                }
            }
        },
    },
    created() {
        this.setValidation();
    }
}
</script>
<style lang="scss" scoped>
.title {
    display: flex;
    justify-content: center;
    max-width: 1200px;
    margin: 30px auto;
    align-items: center;
    .title-text {
        border-bottom: 1px solid #000;
        width: 250px;
        text-align: center;
    }
}
.description {
    display: flex;
    justify-content: center;
    max-width: 1200px;
    margin: 30px auto;
    align-items: center;
}
.image {
    display: flex;
    justify-content: center;
    max-width: 1200px;
    margin: 30px auto;
    align-items: center;
}
.started_at {
    display: flex;
    justify-content: center;
    max-width: 1200px;
    margin: 30px auto;
    align-items: center;
}
.ended_at {
    display: flex;
    justify-content: center;
    max-width: 1200px;
    margin: 30px auto;
    align-items: center;
}
input {
    width: 420px;
    height: 35px;
}
.letter {
    letter-spacing: 22px;
}
.letter-title {
    letter-spacing: 9px;
}
.letter-date {
    letter-spacing: 2px;
}
.edit-area {
    margin-top: 50px;
}
.edit-btn {
    display: flex;
    justify-content: center;
}
</style>