import Vue from "vue";
import VueI18n from "vue-i18n";
Vue.use(VueI18n);

const DEFAULT_LANG = "pt-BR";

const locales = {
    "pt-BR": require("./../../lang/pt-BR.json"),
    bn: require("./i18n/bn.json"),
    en: require("./i18n/en.json"),
    de: require("./i18n/de.json")
};
const i18n = new VueI18n({
    locale: DEFAULT_LANG,
    messages: locales
});

export default i18n;
