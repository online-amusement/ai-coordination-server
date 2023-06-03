<template>
    <div class="container">
        <div class="title">
            <h3 class="title-text">購入管理編集</h3>
        </div>
        <div class="edit-area">
            <form method="POST" action="/payment/save" enctype="multipart/form-data">
                <input type="hidden" name="_token" v-model="csrf">
                <input type="hidden" name="created_at" id="created_at" v-model="created_at">
                <input type="hidden" name="updated_at" id="updated_at" v-model="updated_at">
                <div class="id" v-if="payments">
                    <label class="letter-id">購入管理ID:</label>
                    <input type="text" name="id" id="id" class="form-area" v-model="id" readonly>
                    <strong class="error" v-for="(value,index) in this.errors.id" :key="index">{{ value }}</strong>
                </div>
                <div class="title">
                    <label class="letter-amount">金額:</label>
                    <input type="text" name="amount" id="amount" class="form-area" v-model="amount">
                    <strong class="error" v-for="(value,index) in this.errors.amount" :key="index">{{ value }}</strong>
                </div>
                <div class="description">
                    <label class="letter-point">ポイント:</label>
                    <input type="text" name="points" id="points" class="form-area" v-model="points">
                    <strong class="error" v-for="(value,index) in this.errors.points" :key="index">{{ value }}</strong>
                </div>
                <div class="started_at">
                    <label class="letter-date">掲載開始日時:</label>
                    <input type="datetime-local" name="started_at" id="started_at" class="form-area" v-model="started_at">
                    <strong class="error" v-for="(value,index) in this.errors.started_at" :key="index">{{ value | moment }}</strong>
                </div>
                <div class="ended_at">
                    <label class="letter-date">掲載終了日時:</label>
                    <input type="datetime-local" name="ended_at" id="ended_at" class="form-area" v-model="ended_at">
                    <strong class="error" v-for="(value,index) in this.errors.ended_at" :key="index">{{ value | moment }}</strong>
                </div>
                <div class="edit-btn">
                    <button v-if="news" class="btn btn-warning" style="width:200px;" type="submit">編集</button>
                    <button v-else class="btn btn-warning" style="width:200px;" type="submit">作成</button> 
                </div>
            </form>
            <div class="back-btn">
                <button onClick="history.back();" class="btn btn-secondary" style="width:200px; margin-top:20px;" type="button">戻る</button> 
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:["payments", "old", "errors"],
    data: () => ({
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        id: null,
        created_at: null,
        updated_at: null,
        amount: null,
        points: null,
        started_at : null,
        ended_at: null,
    }),
    mounted() {
        console.log(this.payments)
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
                this.amount = this.old.amount
                this.points = this.old.points
                this.started_at = this.old.started_at
                this.ended_at = this.old.ended_at
            }else {
                if(!this.isEmpty(this.payments)) {
                    this.id = this.payments.id
                    this.amount = this.payments.amount
                    this.points = this.payments.points
                    this.started_at = this.payments.started_at
                    this.ended_at = this.payments.ended_at
                }
            }
        },
    },
    created() {
        this.setValidation();
    },
    filters: {
        moment: function(date) {
            return moment(date).format('YYYY-MM-DD HH:mm:SS')
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
    align-items: center;
    .title-text {
        border-bottom: 1px solid #000;
        width: 250px;
        text-align: center;
    }
}
.id {
    display: flex;
    justify-content: center;
    max-width: 1200px;
    margin: 30px auto;
    align-items: center;
    .letter-id {
        letter-spacing: 5px;
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
.letter-point {
    letter-spacing: 10px;
}
.letter-amount {
    letter-spacing: 25px;
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
.back-btn {
    display: flex;
    justify-content: center;
}
</style>