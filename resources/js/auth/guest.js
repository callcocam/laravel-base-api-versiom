export default (to, from, next) => {
    if (!localStorage.getItem("token")) {
        next();
    } else {
        next({
            name:"admin.dashboards"
        });
    }
};
