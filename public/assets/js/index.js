console.log("Javascript Loaded");

$(function () {
    console.log("JQuery Loaded");

    function search(url, input) {
        const $input = $(input);
        const $autocompleteItems = $input.siblings(".autocomplete-items");
        let timeoutId = null;
        $input.on("focus keyup", function () {
            const value = $input.val();
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        customer: $("#customer").val(),
                        supplier: $("#supplier").val(),
                        column: $input.attr("id"),
                        search: value,
                    },
                    success(data) {
                        if (!data || !data.length) {
                            $autocompleteItems.hide();
                            return;
                        }
                        // console.log(data);
                        const html = data
                            .map(
                                (item) =>
                                    `<div class="autocomplete-item cursor">${item}</div>`
                            )
                            .join("");
                        $autocompleteItems.html(html).show();

                        $autocompleteItems.on(
                            "click",
                            ".autocomplete-item",
                            function () {
                                $input.val($(this).text());
                                $autocompleteItems.hide();
                            }
                        );
                    },
                    error(error) {
                        console.error(error);
                    },
                });
            }, 500);
        });
    }

    $(document).on("click", function (event) {
        if ($(event.target).closest(".autocomplete-items").length === 0) {
            $(".autocomplete-items").hide();
            $(".autocomplete-items").html("");
        }
    });

    selectedCustomer = $("#customer").val();

    search("/search", "#customer");
    search("/search", "#contact");
    search("/search", "#address1");
    search("/search", "#department");
    search("/search", "#country");
    search("/search", "#tax_type");
    search("/search", "#product");
    search("/search", "#supplier");

    $("#customer")
        .siblings(".autocomplete-items")
        .on("click", ".autocomplete-item", function () {
            console.log($(this).text());
            $.ajax({
                url: "/fetch-customer-details",
                data: { customer: $(this).text() },
                type: "GET",
                success(data) {
                    console.log(data);
                    $("#customer").val(data.customer);
                    $("#email").val(data.email);
                    $("#contact").val(data.contact);
                    $("#department").val(data.department);
                    $("#address1").val(data.address1);
                    $("#address2").val(data.address2);
                    $("#city").val(data.city);
                    $("#pincode").val(data.pincode);
                    $("#state").val(data.state);
                    $("#country").val(data.country);
                    $("#phone").val(data.phone);
                    $("#mobile").val(data.mobile);
                    $("#tax_type").val(data.tax_type);
                    $("#gstn").val(data.gstn);
                    $("#pan").val(data.pan);
                },
            });
        });

    $("#address1")
        .siblings(".autocomplete-items")
        .on("click", ".autocomplete-item", function () {
            console.log($(this).text());
            $.ajax({
                url: "/fetch-customer-details",
                data: {
                    address: $(this).text(),
                    customer: $("#customer").val(),
                },
                type: "GET",
                success(data) {
                    console.log(data);
                    $("#customer").val(data.customer);
                    $("#email").val(data.email);
                    $("#contact").val(data.contact);
                    $("#department").val(data.department);
                    $("#address1").val(data.address1);
                    $("#address2").val(data.address2);
                    $("#city").val(data.city);
                    $("#pincode").val(data.pincode);
                    $("#state").val(data.state);
                    $("#country").val(data.country);
                    $("#phone").val(data.phone);
                    $("#mobile").val(data.mobile);
                    $("#tax_type").val(data.tax_type);
                    $("#gstn").val(data.gstn);
                    $("#pan").val(data.pan);
                },
            });
        });

    $("#contact")
        .siblings(".autocomplete-items")
        .on("click", ".autocomplete-item", function () {
            console.log($(this).text());
            $.ajax({
                url: "/fetch-customer-details",
                data: {
                    contact: $(this).text(),
                    customer: $("#customer").val(),
                },
                type: "GET",
                success(data) {
                    console.log(data);
                    $("#customer").val(data.customer);
                    $("#email").val(data.email);
                    $("#contact").val(data.contact);
                    $("#department").val(data.department);
                    $("#address1").val(data.address1);
                    $("#address2").val(data.address2);
                    $("#city").val(data.city);
                    $("#pincode").val(data.pincode);
                    $("#state").val(data.state);
                    $("#country").val(data.country);
                    $("#phone").val(data.phone);
                    $("#mobile").val(data.mobile);
                    $("#tax_type").val(data.tax_type);
                    $("#gstn").val(data.gstn);
                    $("#pan").val(data.pan);
                },
            });
        });

    ["#gstn", "#pan", "#state_code"].forEach(function (selector) {
        $(selector).on("input", function () {
            if (this && this.value) {
                this.value = this.value.slice(0, $(this).data("maxlength"));
            }
        });
    });

    $("#gstn").data("maxlength", 15);
    $("#pan").data("maxlength", 10);
    $("#state_code").data("maxlength", 2);

    $("#gstn").on("input", function () {
        $("#pan").val(this.value.slice(2, 12));
        $("#state_code").val(this.value.slice(0, 2));
    });

    $("#price_basis, #delivery").on("change", function () {
        $("#update-quote-form").submit();
    });
    $("#update-quote-form").on("submit", function (event) {
        event.preventDefault();
        let url = $(this).attr("action");
        $.ajax({
            url: url,
            data: $(this).serialize(),
            type: "POST",
            success(data) {
                console.log(data);
            },
            error(error) {
                console.error(error);
            },
        });
    });
});
