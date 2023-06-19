new Vue({
    el: "#age",
    data: {
        age: 25
    },
    methods: {
        add: function (getAge) {
            this.age+=getAge;
            // this.age=this.age+getAge;
        },
        subtract: function(getAge){
            this.age-=getAge;
        }
    }
});