<template>
    <div class="container">
        <div class="title">
            <h3 class="title-text">{{ this.date }}</h3>
        </div>
        <div class="contents">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>メンバーID</th>
                        <th>ニックネーム</th>
                        <th>月の合計購入金額</th>
                        <th>月の累計取得ポイント</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(i,index) in summary" :key="index">
                        <td>{{ i.member.id }}</td>
                        <td>{{ i.member.nickname }}</td>
                        <td>{{ i.total_amount }}</td>
                        <td>{{ i.total_point }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="back-btn">
            <button onClick="history.back();" class="btn btn-secondary" style="width:200px; margin-top:20px;" type="button">戻る</button> 
        </div>
    </div>
</template>
<script>
export default {
    props:["summary", "date"],
    mounted() {
        console.log(this.summary)
        console.log(this.date)
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
.back-btn {
    display: flex;
    justify-content: center;
}
</style>