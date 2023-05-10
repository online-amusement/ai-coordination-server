<template>
    <div class="container">
        <div class="title">
            <h3 class="title-text">メンバー管理</h3>
        </div>
        <div class="search-form">
            <form method="GET" action="/home" class="form-area">
                <div class="search-text-inp">
                    <div class="group-form">
                        <div class="searchMemberId">
                            <label class="memberId">メンバーId:</label>
                            <input type="text" v-model="memberId" class="searchMemberId" name="searchMemberId" id="searchMemberId">
                        </div>
                        <div class="searchMemberStatus">
                            <label class="memberStatus">状態:</label>
                            <input type="text" v-model="status" class="searchStatus" name="searchStatus" id="searchStatus">
                        </div>
                    </div>
                    <div class="searchMemberDate">
                        <div class="start">
                            <label class="started">登録日時(開始):</label>
                            <input type="date" v-model="started_at" name="searchStartDate" class="searchStartDate" id="searchStartDate">
                        </div>
                        <div class="wave-line">
                            <label class="line">〜</label>
                        </div>
                        <div class="end">
                            <label class="memberId">登録日時(終了):</label>
                            <input type="date" v-model="ended_at" name="searchEndDate" class="searchEndDate" id="searchEndDate">
                        </div>
                    </div>
                    <div class="searchSort">
                        <label class="sort">ソート</label>
                        <input type="text" v-model="sort" name="searchSort" id="searchSort" class="searchSort">
                    </div>
                </div>
                <div class="form-btn">
                    <div class="search">
                        <button @click="searchMember()" class="btn btn-primary" type="button">検索</button>
                    </div>
                    <div class="delete">
                        <button @click="clear" class="btn btn-danger" type="button">クリア</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="contents">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>管理ID</th>
                        <th>ニックネーム</th>
                        <th>メールアドレス</th>
                        <th>状態</th>
                        <th>ポイント</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="member in members.data" :key="member.id">
                        <td>{{ member.id }}</td>
                        <td>{{ member.nickname }}</td>
                        <td>{{ member.email }}</td>
                        <td>{{ member.status }}</td>
                        <td>{{ member.points }}</td>
                        <td>
                            <button class="btn btn-warning" type="button"><a href="" class="edit-btn">編集</a></button>
                            <button class="btn btn-danger" type="button"><a href="" class="delete-btn">削除</a></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="paginate">
            <div class="page" v-for="(link,index) in members.links" :key="index">
                <button :disabled="link.url == null" class="btn btn-secondary" :class="{'pagination-link-enabled': link.url !== null,'pagination-link-active': link.active}"><a :disabled="link.url == null" :href="link.url" class="link-btn">{{ link.label }}</a></button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['members'],
    data:() => ({
        memberId: null,
        status: null,
        started_at: null,
        ended_at: null,
        sort: null,
        loader: false,
    }),
    mounted() {
        console.log(this.members)
    },
    methods: {
        searchMember() {
            let params = {
                'searchMemberId': this.memberId,
                'searchStatus': this.status
            }
            let baseUrl = "http://local.ai-coordination/home";
            let url = baseUrl + "?" + Object.entries(params).map((e) => {
                let key = e[0];
                let value = encodeURI(e[1]);
                return `${key}=${value}`;
            }).join("&");
            console.log(url)
            let queryParams = window.location.search
            const getSearchParams = new URLSearchParams(queryParams)
            console.log(getSearchParams)
        },
        clear() {

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
    .searchMemberDate {
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
</style>