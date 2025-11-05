// storage.js — tiny wrapper for saved flags & category
const DMVStore = (function(){
  const KEY = "dmv_practice_v1";
  function load(){
    try {
      const raw = localStorage.getItem(KEY);
      return raw ? JSON.parse(raw) : {};
    } catch(e){
      return {};
    }
  }
  function save(obj){
    try { localStorage.setItem(KEY, JSON.stringify(obj||{})); } catch(e){}
  }
  function clear(){
    try { localStorage.removeItem(KEY); } catch(e){}
  }
  return { load, save, clear };
})();
