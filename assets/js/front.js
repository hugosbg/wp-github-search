(function ($) {

    $("#githubsearch_repor").autocomplete({
        source: function (request, response) {
            const url = `https://api.github.com/search/repositories?per_page=10&q=${request.term}`;
            $.ajax({
                url: url,
                dataType: "json",
                success: function (data) {
                    response(data.items);
                },
                error: function (xhr) {
                    console.log('error:', xhr)
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            const {owner} = ui.item;
            const {url, separator} = GithubSearch;
            window.location = `${url}${separator}user=${owner.login}`;
            return false;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        return $("<li>")
            .append(item.full_name)
            .appendTo(ul);
    }

}(jQuery));