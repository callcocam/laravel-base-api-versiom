export default (to, from, next) => {
    if (localStorage.getItem("token")) {
        next();
    } else {
        localStorage.removeItem("token");
        next({
            name:"admin.auth.login"
        });
    }
};
