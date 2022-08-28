var reacts = {
  // (A) PROPERTIES
  cid : 999, // fixed dummy "content id"
  lidi : null, // like/dislike button

  // (B) INITIALIZE
  init : () => {
    cb.api({
      mod : "reacts", req : "get",
      data : { id : reacts.cid },
      passmsg : false,
      onpass : res => {
        reacts.lidi = lidi({
          hWrap : document.getElementById("demo"),
          status : res.data.user ? res.data.user : 0,
          count : res.data.react,
          change : reacts.save
        });
      }
    });
  },

  // (C) SAVE LIKE/DISLIKE STATUS
  save : status => {
    cb.api({
      mod : "reacts", req : "save", data : {
        id : reacts.cid,
        reaction : status
      },
      passmsg : false,
      onpass : res => {
        reacts.lidi.recount(res.data.react);
      }
    });
  }
};
window.onload = reacts.init;