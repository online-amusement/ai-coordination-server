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
                            <button class="btn btn-warning" type="button"><a :href="'/member/' + member.id + '/edit'" class="edit-btn">編集</a></button>
                            <button class="btn btn-danger" type="button"><a :href="'/member/' + member.id + '/delete'" class="delete-btn">削除</a></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="members.data.length == 0" class="no-contents">
            <p>検索結果が存在しません。</p>
        </div>
        <div class="paginate">
            <div class="page" v-for="(link,index) in members.links" :key="index">
                <button type="submit" :disabled="link.url == null" class="btn btn-secondary" :class="{'pagination-link-enabled': link.url !== null,'pagination-link-active': link.active}"><a @click.prevent="searchMember(link.label)" :disabled="link.url == null" href="#" class="link-btn">{{ link.label }}</a></button>
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
        page: '1',
        sort: [
            {text: '降順', value: 'desc'},
            {text: '昇順', value: 'asc'}
        ],
        loader: false,
    }),
    mounted() {
        console.log(this.members)
    },
    methods: {
        searchMember(pageNum) {
            this.page = pageNum
            const searchParams = new URLSearchParams(document.location.search)
            const val = searchParams.get("page")
            //urlのパラメータの値を変更
            if(this.page == val) {
                searchParams.set("page", this.page);
            }else {
                searchParams.set("page", this.page);
            }
            const params = {
                'searchMemberId': this.memberId ? this.memberId : "",
                'searchStatus': this.status ? this.status : "",
                'searchStartDate': this.started_at ? this.started_at : "",
                'searchEndDate': this.ended_at ? this.ended_at : "",
                'searchSort': this.sort ? this.sort : "",
                'page': this.page
            }
            for(let param of searchParams) {
                params[param[0]] = param[1]
            }
            let baseUrl = this.members.path;
            let url = baseUrl + "?" + Object.entries(params).map((e) => {
                let key = e[0];
                let value = encodeURI(e[1]);
                return `${key}=${value}`;
            }).join("&");
            location.href = url   
        },
        clear() {
            const searchParams = new URLSearchParams(document.location.search)
            const val = searchParams.get("page")
            //urlのパラメータの値をset
            searchParams.set("searchMemberId", "");
            searchParams.set("searchStatus", "");
            searchParams.set("searchStartDate", "");
            searchParams.set("searchEndDate", "");
            searchParams.set("searchSort", "");
            searchParams.set("page", "1");
            const params = {
                'searchMemberId': this.memberId ? this.memberId : "",
                'searchStatus': this.status ? this.status : "",
                'searchStartDate': this.started_at ? this.started_at : "",
                'searchEndDate': this.ended_at ? this.ended_at : "",
                'searchSort': this.sort ? this.sort : "",
                'page': this.page
            }
            let baseUrl = this.members.path;
            console.log(baseUrl)
            let url = baseUrl + "?" + Object.entries(params).map((e) => {
                let key = e[0];
                let value = encodeURI(e[1]);
                return `${key}=${value}`;
            }).join("&");
            location.href = url
        }
    },
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
    .create-btn {
        color: #fff;
        text-decoration: none;
    }
    .no-contents {
        display: flex;
        justify-content: center;
        margin-bottom: 50px;
        font-weight: 700;
        font-size: large;
    }
</style>