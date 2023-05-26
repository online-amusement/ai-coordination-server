<template>
    <div class="container">
        <div class="title">
            <h3 class="title-text">メンバー編集</h3>
        </div>
        <div class="edit-area">
            <form method="POST" action="/member/save" enctype="multipart/form-data">
                <input type="hidden" name="_token" v-model="csrf">
                <input type="hidden" name="created_at" id="created_at" v-model="created_at">
                <input type="hidden" name="updated_at" id="updated_at" v-model="updated_at">
                <div class="id">
                    <label class="letter-id">管理ID：</label>
                    <input type="text" name="id" id="id" class="form-area" style="width:250px; height:35px;" v-model="id" readonly>
                    <strong class="error" v-for="(value,index) in this.errors.id" :key="index">{{ value }}</strong>
                </div>
                <div class="nickname">
                    <label class="letter-nickname">ニックネーム：</label>
                    <input type="text" name="nickname" id="nickname" class="form-area" style="width:250px; height:35px;" v-model="nickname">
                    <strong class="error" v-for="(value,index) in this.errors.nickname" :key="index">{{ value }}</strong>
                </div>
                <div class="point">
                    <label class="letter-point">ポイント：</label>
                    <input type="text" name="points" id="points" class="form-area" style="width:250px; height:35px;" v-model="point">
                    <strong class="error" v-for="(value,index) in this.errors.point" :key="index">{{ value }}</strong>
                </div>
                <div class="status">
                    <label class="letter-status">状態：</label>
                    <input type="text" name="status" id="status" class="form-area" style="width:250px; height:35px;" v-model="status">
                    <strong class="error" v-for="(value,index) in this.errors.status" :key="index">{{ value }}</strong>
                </div>
                <div class="edit-btn">
                    <button v-if="members" class="btn btn-warning" style="width:200px;" type="submit">編集</button>
                    <button v-else class="btn btn-warning" style="width:200px;" type="submit">作成</button> 
                </div>
            </form>
            <div class="edit-btn">
                <button onClick="history.back();" class="btn btn-secondary" style="width:200px; margin-top:20px;" type="button">戻る</button> 
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:["members", "errors", "old"],
    data: () => ({  
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        id: null,
        created_at: null,
        updated_at: null,
        nickname: null,
        point: null,
        status: null,
    }),
    mounted() {
        console.log(this.members)
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
                this.nickname = this.old.nickname
                this.point = this.old.points
                this.status = this.old.status
            }else {
                if(!this.isEmpty(this.members)) {
                    this.id = this.members.id
                    this.nickname = this.members.nickname
                    this.point = this.members.points
                    this.status = this.members.status
                }
            }
        },
    },
    created() {
        this.setValidation();
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
    .id {
        display: flex;
        justify-content: center;
        max-width: 1200px;
        margin: 30px auto;
        align-items: center;
    }
    .nickname {
        display: flex;
        justify-content: center;
        max-width: 1200px;
        margin: 30px auto;
        align-items: center;
    }
    .point {
        display: flex;
        justify-content: center;
        max-width: 1200px;
        margin: 30px auto;
        align-items: center;
    }
    .status {
        display: flex;
        justify-content: center;
        max-width: 1200px;
        margin: 30px auto;
        align-items: center;
    }
    .edit-area {
        margin-top: 50px;
    }
    .edit-btn {
        display: flex;
        justify-content: center;
    }
    .letter-id {
        letter-spacing: 8px;
    }
    .letter-point {
        letter-spacing: 4.5px;
    }
    .letter-status {
        letter-spacing: 16px;
    }
</style>