window.addEventListener("load", () => {
  // (A) NEW FLOW OBJECT
  var flow = new Flow({
    target: cbhost.api + "upload/recv/",
    chunkSize: 1024*1024, // 1 mb
    singleFile: true
  });

  // (B) FLOW SUPPORTED
  if (flow.support) {
    // (B1) ASSIGN BROWSE BUTTON
    flow.assignBrowse(document.getElementById("upbrowse"));
    // OR DEFINE DROP ZONE
    // flow.assignDrop(document.getElementById("updrop"));

    // (B2) ON FILE ADDED
    flow.on("fileAdded", (file, event) => {
      let fileslot = document.createElement("div");
      fileslot.id = file.uniqueIdentifier;
      fileslot.className = "p-3 mb-2 bg-dark text-white";
      fileslot.innerHTML = `${file.name} (${file.size}) - <strong>0%</strong>`;
      document.getElementById("uplist").appendChild(fileslot);
    });

    // (B3) ON FILE SUBMITTED (ADDED TO UPLOAD QUEUE)
    flow.on("filesSubmitted", (array, event) => {
      flow.upload();
    });

    // (B4) ON UPLOAD PROGRESS
    flow.on("fileProgress", (file, chunk) => {
      let progress = (chunk.offset + 1) / file.chunks.length * 100;
      progress = progress.toFixed(2) + "%";

      let fileslot = document.getElementById(file.uniqueIdentifier);
      fileslot = fileslot.getElementsByTagName("strong")[0];
      fileslot.innerHTML = progress;
    });

    // (B5) ON UPLOAD SUCCESS
    flow.on("fileSuccess", (file, message, chunk) => {
      let fileslot = document.getElementById(file.uniqueIdentifier);
      fileslot = fileslot.getElementsByTagName("strong")[0];
      fileslot.innerHTML = "DONE";
    });

    // (B6) ON UPLOAD ERROR
    flow.on("fileError", (file, message) => {
      let fileslot = document.getElementById(file.uniqueIdentifier);
      fileslot = fileslot.getElementsByTagName("strong")[0];
      fileslot.innerHTML = "ERROR";
    });

    // (B7) PAUSE/CONTINUE UPLOAD
    document.getElementById("upToggle").addEventListener("click", () => {
      if (flow.isUploading()) { flow.pause(); }
      else { flow.resume(); }
    });
  }
});