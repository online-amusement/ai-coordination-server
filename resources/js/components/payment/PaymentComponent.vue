<template>
    <div class="container">
        <div class="title">
            <h3 class="title-text">購入管理</h3>
        </div>
        <div class="search-form">
            <form method="GET" action="/payment" class="form-area">
                <div class="search-text-inp">
                    <div class="group-form">
                        <div class="searchPaymnetId">
                            <label class="searchPaymnetId">購入Id:</label>
                            <input type="text" v-model="paymentId" class="searchPaymnetId" name="searchPaymnetId" id="searchPaymnetId">
                        </div>
                        <div class="searchAmount">
                            <label class="searchAmount">金額:</label>
                            <input type="text" v-model="amount" class="searchAmount" name="searchAmount" id="searchAmount">
                        </div>
                    </div>
                    <div class="searchPaymentDate">
                        <div class="startAt">
                            <label class="started">登録日時(開始):</label>
                            <input type="date" v-model="startAt" name="searchSatrtedAt" class="searchSatrtedAt" id="searchSatrtedAt">
                        </div>
                        <div class="wave-line">
                            <label class="line">〜</label>
                        </div>
                        <div class="endAt">
                            <label class="ended">登録日時(終了):</label>
                            <input type="date" v-model="endAt" name="searchEndedAt" class="searchEndedAt" id="searchEndedAt">
                        </div>
                    </div>
                    <div class="searchSort">
                        <label class="sort">ソート</label>
                        <select v-model="sort" name="searchSort" id="searchSort" class="searchSort">
                            <option>降順</option>
                            <option>昇順</option>
                        </select>
                    </div>
                </div>
                <div class="form-btn">
                    <div class="search">
                        <button @click="searchPayments()" class="btn btn-primary" type="submit">検索</button>
                    </div>
                    <div class="delete">
                        <button @click="clear" class="btn btn-danger" type="button">クリア</button>
                    </div>
                </div>
            </form>
        </div>
        <button class="btn btn-primary" type="button"><a :href="'/payment/create'" class="create-btn">作成</a></button>
        <div class="contents">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>購入ID</th>
                        <th>金額</th>
                        <th>ポイント数</th>
                        <th>掲載開始日時</th>
                        <th>掲載終了日時</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="payment in payments.data" :key="payment.id">
                        <td>{{ payment.id }}</td>
                        <td>{{ payment.amount }}</td>
                        <td>{{ payment.points }}</td>
                        <td>{{ payment.started_at }}</td>
                        <td>{{ payment.ended_at }}</td>
                        <td>
                            <button class="btn btn-warning" type="button"><a :href="'/payment/' + payment.id + '/edit'" class="edit-btn">編集</a></button>
                            <button class="btn btn-danger" type="button"><a :href="'/payment/' + payment.id + '/delete'" class="delete-btn">削除</a></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="payments.data.length == 0" class="no-contents">
            <p>検索結果が存在しません。</p>
        </div>
        <div class="paginate">
            <div class="page" v-for="(link,index) in payments.links" :key="index">
                <button type="submit" :disabled="link.url == null" class="btn btn-secondary" :class="{'pagination-link-enabled': link.url !== null,'pagination-link-active': link.active}"><a @click.prevent="searchPayments(link.label)" :disabled="link.url == null" href="#" class="link-btn">{{ link.label }}</a></button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['payments'],
    data:() => ({
        paymentId: null,
        amount: null,
        startAt: null,
        endAt: null,
        sort: [
            {text: '降順', value: 'desc'},
            {text: '昇順', value: 'asc'}
        ],
        loader: false,
    }),
    mounted() {
        console.log(this.payments)
    },
    methods: {
        searchPayments(pageNum) {
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
                'searchPaymnetId': this.paymentId ? this.paymentId : "",
                'searchAmount': this.amount ? this.amount : "",
                'searchSatrtedAt': this.startAt ? this.startAt : "",
                'searchEndedAt': this.endAt ? this.endAt : "",
                'searchSort': this.sort ? this.sort : "",
                'page': this.page
            }
            for(let param of searchParams) {
                params[param[0]] = param[1]
            }
            let baseUrl = this.payments.path;
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
            searchParams.set("searchPaymnetId", "");
            searchParams.set("searchAmount", "");
            searchParams.set("searchSatrtedAt", "");
            searchParams.set("searchEndDate", "");
            searchParams.set("searchSort", "");
            searchParams.set("page", "1");
            const params = {
                'searchPaymnetId': this.paymentId ? this.paymentId : "",
                'searchAmount': this.amount ? this.amount : "",
                'searchSatrtedAt': this.startAt ? this.startAt : "",
                'searchEndDate': this.endAt ? this.endAt : "",
                'searchSort': this.sort ? this.sort : "",
                'page': this.page
            }
            let baseUrl = this.payments.path;
            console.log(baseUrl)
            let url = baseUrl + "?" + Object.entries(params).map((e) => {
                let key = e[0];
                let value = encodeURI(e[1]);
                return `${key}=${value}`;
            }).join("&");
            location.href = url
        }
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
    .searchPaymentDate {
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    .searchPaymnetId {
        margin-right: 100px;
    }
    .startAt {
        margin-right: 50px;
    }
    .endAt {
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
        margin-bottom: 50px;
        font-weight: 700;
        font-size: large;
    }
    .create-btn {
        color: #fff;
        text-decoration: none;
    }
    .search-text-inp {
        margin-bottom:30px;
    }
</style>