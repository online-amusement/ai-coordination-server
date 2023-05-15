<template>
    <div class="container">
        <div class="title">
            <h3 class="title-text">お知らせ管理</h3>
        </div>
        <div class="search-form">
            <form method="GET" action="/news" class="form-area">
            <input type="hidden" name="referer" v-model="referer">
                <div class="search-text-inp">
                    <div class="group-form">
                        <div class="searchMemberId">
                            <label class="newsId">お知らせID:</label>
                            <input type="text" v-model="newsId" class="searchNewsId" name="searchNewsId" id="searchNewsId">
                        </div>
                    </div>
                    <div class="searchNewsDate">
                        <div class="start">
                            <label class="started">登録日時(開始):</label>
                            <input type="datetime-local" v-model="startDate" name="searchStartDate" class="searchStartDate" id="searchStartDate">
                        </div>
                        <div class="wave-line">
                            <label class="line">〜</label>
                        </div>
                        <div class="end">
                            <label class="memberId">登録日時(終了):</label>
                            <input type="datetime-local" v-model="endDate" name="searchEndDate" class="searchEndDate" id="searchEndDate">
                        </div>
                    </div>
                    <div class="searchSort">
                        <label class="sort">ソート</label>
                        <select v-model="sort" name="searchSort" id="searchSort" class="searchSort">
                            <option>昇順</option>
                            <option>降順</option>
                        </select>
                    </div>
                </div>
                <div class="form-btn">
                    <div class="search">
                        <button @click="searchMember()" class="btn btn-primary" type="submit">検索</button>
                    </div>
                    <div class="delete">
                        <button @click="clear" class="btn btn-danger" type="submit">クリア</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="contents">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>お知らせID</th>
                        <th>タイトル</th>
                        <th>説明</th>
                        <th>掲載開始日時</th>
                        <th>掲載終了日時</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="el in news.data" :key="el.id">
                        <td>{{ el.id }}</td>
                        <td>{{ el.title }}</td>
                        <td>{{ el.description }}</td>
                        <td>{{ el.started_at }}</td>
                        <td>{{ el.ended_at }}</td>
                        <td>
                            <button class="btn btn-primary" type="button"><a :href="'/news/create'" class="create-btn">作成</a></button>
                            <button class="btn btn-warning" type="button"><a :href="'/news/' + el.id + '/edit'" class="edit-btn">編集</a></button>
                            <button class="btn btn-danger" type="button"><a :href="'/news/' + el.id + '/delete'" class="delete-btn">削除</a></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="news.data.length == 0" class="no-contents">
            <p>検索結果が存在しません。</p>
        </div>
        <div class="paginate">
            <div class="page" v-for="(link,index) in news.links" :key="index">
                <button :disabled="link.url == null" class="btn btn-secondary" :class="{'pagination-link-enabled': link.url !== null,'pagination-link-active': link.active}"><a @click="searchMember()" :disabled="link.url == null" :href="link.url" class="link-btn">{{ link.label }}</a></button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['news'],
    data:() => ({
        newsId: null,
        startDate: null,
        endDate: null,
        sort: {
            asc: '昇順',
            desc: '降順'
        },
        loader: false,
    }),
    mounted() {
        console.log(this.news)
    },
    methods: {
        searchMember() {
            this.loader = true;
            let params = {
                'searchNewsId': this.newsId,
                'searchStartDate': this.startDate,
                'searchEndDate': this.endDate,
                'searchSort': this.sort,
            }
            let baseUrl = "http://local.ai-coordination/news";
            let url = baseUrl + "?" + Object.entries(params).map((e) => {
                let key = e[0];
                let value = encodeURI(e[1]);
                return `${key}=${value}`;
            }).join("&");    
        },
        clear() {
            this.newsId = '';
            this.startDate = '';
            this.endDate = '';
        },
    }
}
</script>
<style lang="scss" scoped>
    .title {
        display: flex;
        justify-content: center;
        max-width: 1200px;
        margin: 30px auto;
        .title-text {
            border-bottom: 1px solid #000;
            width: 250px;
            text-align: center;
        }
    }
    .search-form {
        border: 1px solid #DDDDDD;
        max-width: 1000px;
        margin: 30px auto;
    }
    .form-area {
        margin: 50px;
    }
    table {
        margin: 50px auto;
        width: 1100px;
    }
    .form-btn {
        justify-content: center;
        display: flex;
    }
    .search-btn {
        margin-right: 5px;
        border: none;
        color: #fff;
        background: #0000FF;
    }
    .clear-btn {
        margin-left: 5px;
        border: none;
        color: #fff;
        background: #FF0000;
    }
    .paginate {
        display: flex;
        justify-content: center;
    }
    .link-btn {
        color: #fff;
        text-decoration: none;
    }
    .edit-btn {
        text-decoration: none;
        color: black;
    }
    .delete-btn {
        text-decoration: none;
        color: #fff;
    }
    .group-form {
        display: flex;
    }
    .searchNewsDate {
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    .searchMemberId {
        margin-right: 100px;
    }
    .start {
        margin-right: 50px;
    }
    .end {
        margin-left: 50px;
    }
    .search {
        margin-right: 5px;
    }
    .delete {
        margin-left: 5px;
    }
    input {
        width: 200px;
        height: 35px;
    }
    .pagination-link {
        width: 30px;
        height: 30px;
    }
    .no-contents {
        display: flex;
        justify-content: center;
    }
    .create-btn {
        color: #fff;
        text-decoration: none;
    }
</style>
