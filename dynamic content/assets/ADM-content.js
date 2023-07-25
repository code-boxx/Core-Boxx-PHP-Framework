var content = {
  // (A) SHOW ALL CONTENTS
  pg : 1, // current page
  find : "", // current search
  list : () =>  {
    cb.page(1);
    cb.load({
      page : "admin/content/list", target : "content-list",
      data : {
        page : content.pg,
        id : content.id,
        search : content.find
      }
    });
  },

  // (B) GO TO PAGE
  //  pg : int, page number
  goToPage : pg => { if (pg!=content.pg) {
    content.pg = pg;
    content.list();
  }},

  // (C) SEARCH CLASSIFIEDS
  search : () => {
    content.find = document.getElementById("content-search").value;
    content.pg = 1;
    content.list();
    return false;
  },

  // (D) SHOW ADD/EDIT DOCKET
  // id : content ID, for edit only
  addEdit : id => cb.load({
    page : "admin/content/form", target : "cb-page-2",
    data : { id : id ? id : "" },
    onload : () => {
      cb.page(2);
      tinymce.remove();
      tinymce.init({
        selector : "#content_text",
        menubar : false,
        plugins: "lists link",
        toolbar: "bold italic underline | forecolor | bullist numlist | alignleft aligncenter alignright alignjustify | link"
      });
    }
  }),

  // (E) SAVE CONTENT
  save : () => {
    // (E1) MANUAL CHECK TINYMCE TEXT (HTML REQUIRED DOES NOT WORK)
    var text = tinymce.get("content_text").getContent();
    if (text=="") {
      cb.modal("Error", "Please fill in the content body.");
      return false;
    }

    // (E2) GET DATA
    var data = {
      slug : document.getElementById("content_slug").value,
      title : document.getElementById("content_title").value,
      text : text
    };
    var id = document.getElementById("content_id").value;
    if (id!="") { data.id = id; }

    // (E3) AJAX
    cb.api({
      mod : "contents", act : "save",
      data : data,
      passmsg : "Content Saved",
      onpass : content.list
    });
    return false;
  },

  // (F) DELETE CONTENT
  //  id : int, content ID
  //  confirm : boolean, confirmed delete
  del : id => cb.modal("Please confirm", "Delete this entry?", () => cb.api({
    mod : "contents", act : "del",
    data : { id: id },
    passmsg : "Content Deleted",
    onpass : content.list
  }))
};
window.addEventListener("load", content.list);