// when the element of the id "delete-article" is clicked, run this function
$("a.delete").on("click", function (e) {
  e.preventDefault(); // Prevent default action (e.g., form submission or link click)

  if (confirm("Are you sure?")) {
    var fmr = $("<form>");
    fmr.attr("method", "post");
    fmr.attr("action", $(this).attr("href"));
    fmr.appendTo("body");
    fmr.submit();
  }
});

$.validator.addMethod(
  "dateTime",
  function (value, element) {
    return value === "" || !isNaN(Date.parse(value));
  },
  "Must be a valid date and time"
);

$("#formArticle").validate({
  rules: {
    title: {
      required: true,
    },
    content: {
      required: true,
    },
    published_at: {
      dateTime: true,
    },
  },
});

$("#formContact").validate({
  rules: {
    email: {
      required: true,
      email: true,
    },
    subject: {
      required: true,
    },
    message: {
      required: true,
    },
  },
});
