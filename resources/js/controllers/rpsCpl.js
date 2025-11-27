// public/js/controllers/cpl.js

function cpl(cplListCount, cplListArray) {
    return {
        selectAll: false,
        selected: [],
        isDisabled: true,

        toggleAll() {
            this.selected = this.selectAll 
                ? cplListArray.map((_, i) => i)
                : [];
        },

        reset() {
            this.selectAll = false;
            this.selected = [];
        },

        init() {
            this.$watch('selected', value => {
                this.isDisabled = value.length === 0;
                this.selectAll = value.length === cplListCount;
            });
        }
    }
}

window.cpl = cpl;
