<?php require PATH_PAGES . "TEMPLATE-top.php"; ?>
<!-- (A) UPLOAD FORM -->
<input type="button" id="upbrowse" value="Browse"/>
<input type="button" id="upToggle" value="Pause OR Continue"/>
<div id="uplist"></div>

<!-- (B) JAVASCRIPT -->
<script src="<?=HOST_ASSETS?>flow.min.js"></script>
<script>
window.addEventListener("load", () => {
  // (B1) NEW FLOW OBJECT
  var flow = new Flow({
    target: "<?=HOST_API?>upload/recv/",
    chunkSize: 1024*1024, // 1 mb
    singleFile: true
  });

  if (flow.support) {
    // (B2) ASSIGN BROWSE BUTTON
    flow.assignBrowse(document.getElementById("upbrowse"));
    // OR DEFINE DROP ZONE
    // flow.assignDrop(document.getElementById("updrop"));

    // (B3) ON FILE ADDED
    flow.on("fileAdded", (file, event) => {
      let fileslot = document.createElement("div");
      fileslot.id = file.uniqueIdentifier;
      fileslot.innerHTML = `${file.name} (${file.size}) - <strong>0%</strong>`;
      document.getElementById("uplist").appendChild(fileslot);
    });

    // (B4) ON FILE SUBMITTED (ADDED TO UPLOAD QUEUE)
    flow.on("filesSubmitted", (array, event) => {
      flow.upload();
    });

    // (B5) ON UPLOAD PROGRESS
    flow.on("fileProgress", (file, chunk) => {
      let progress = (chunk.offset + 1) / file.chunks.length * 100;
      progress = progress.toFixed(2) + "%";

      let fileslot = document.getElementById(file.uniqueIdentifier);
      fileslot = fileslot.getElementsByTagName("strong")[0];
      fileslot.innerHTML = progress;
    });

    // (B6) ON UPLOAD SUCCESS
    flow.on("fileSuccess", (file, message, chunk) => {
      let fileslot = document.getElementById(file.uniqueIdentifier);
      fileslot = fileslot.getElementsByTagName("strong")[0];
      fileslot.innerHTML = "DONE";
    });

    // (B7) ON UPLOAD ERROR
    flow.on("fileError", (file, message) => {
      let fileslot = document.getElementById(file.uniqueIdentifier);
      fileslot = fileslot.getElementsByTagName("strong")[0];
      fileslot.innerHTML = "ERROR";
    });

    // (B8) PAUSE/CONTINUE UPLOAD
    document.getElementById("upToggle").addEventListener("click", () => {
      if (flow.isUploading()) { flow.pause(); }
      else { flow.resume(); }
    });
  }
});
</script>
<?php require PATH_PAGES . "TEMPLATE-bottom.php"; ?>
