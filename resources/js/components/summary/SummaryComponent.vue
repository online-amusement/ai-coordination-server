<template>
    <div class="container">
        <div class="title">
            <h3 class="title-text">購入履歴管理</h3>
        </div>
        <div class="contents">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>購入履歴ID</th>
                        <th>購入月</th>
                        <th>合計売上</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(i,index) in summaries" :key="index">
                        <td>{{ i.id }}</td>
                        <td>{{ i.date }}</td>
                        <td>{{ i.total_amount }}</td>
                        <td>
                            <button class="btn btn-warning" type="button"><a :href="'/summary/' + i.date + '/show'" class="edit-btn">詳細</a></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    props:['summaries'],
    data:() => ({
        
    }),
    mounted() {
        console.log(this.summaries)
    },
    methods: {
        
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