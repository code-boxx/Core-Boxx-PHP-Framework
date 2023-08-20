window.addEventListener("load", () => {
  // (A) NEW FLOW OBJECT
  var flow = new Flow({
    target: cbhost.api + "upload/recv/",
    chunkSize: 5120*1024, // 5 mb
    singleFile: true
  });

  // (B) ASSIGN BROWSE BUTTON (OR DROP ZONE)
  flow.assignBrowse(document.getElementById("upbrowse"));
  // flow.assignDrop(document.getElementById("updrop"));

  // (C) ON FILE ADDED
  flow.on("fileAdded", (file, evt) => {
    let slot = document.createElement("div");
    slot.id = file.uniqueIdentifier;
    slot.className = "p-3 mb-2 bg-dark text-white";
    slot.innerHTML = `${file.name} (${file.size}) - <strong>0%</strong>`;
    document.getElementById("uplist").appendChild(slot);
  });

  // (D) ON FILE SUBMITTED (ADDED TO UPLOAD QUEUE)
  flow.on("filesSubmitted", (arr, evt) => flow.upload());
  
  // (E) ON UPLOAD PROGRESS
  flow.on("fileProgress", (file, chunk) => 
    document.getElementById(file.uniqueIdentifier).querySelector("strong").innerHTML = 
    ((chunk.offset + 1) / file.chunks.length * 100).toFixed(2) + "%"
  );

  // (F) ON UPLOAD SUCCESS
  flow.on("fileSuccess", (file, msg, chunk) => 
    document.getElementById(file.uniqueIdentifier).querySelector("strong").innerHTML = "DONE"
  );

  // (G) ON UPLOAD ERROR
  flow.on("fileError", (file, msg) => 
    document.getElementById(file.uniqueIdentifier).querySelector("strong").innerHTML = "ERROR - " + msg
  );

  // (H) PAUSE/CONTINUE UPLOAD
  document.getElementById("uptoggle").addEventListener("click", () => {
    if (flow.isUploading()) { flow.pause(); }
    else { flow.resume(); }
  });
});