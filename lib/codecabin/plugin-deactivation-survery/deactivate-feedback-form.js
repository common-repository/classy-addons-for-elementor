(function($) {


	if(!window.classyea)
		window.classyea = {};
	
	if(classyea.DeactivateFeedbackForm)
		return;
	
	function DeactivateFeedbackForm(plugin)
	{
		var self = this;
		var strings = classyea_deactivate_feedback_form_strings;
		
		this.plugin = plugin;
		
		// Dialog HTML
		var element = $('\
			<div class="classyea-deactivate-dialog" data-remodal-id="' + plugin.slug + '">\
				<form>\
					<input type="hidden" name="plugin"/>\
					<input type="hidden" id="_wpnonce" name="_wpnonce" value="' + strings.classy_uninstall_nonce + '">\
					<h2>' + strings.quick_feedback + '</h2>\
					<p>\
						' + strings.foreword + '\
					</p>\
					<ul class="classyea-deactivate-reasons"></ul>\
					<input name="comments" placeholder="' + strings.brief_description + '"/>\
					<input type="hidden" name="admin_email" value="' + strings.admin_email + '"/>\
					<input type="hidden" name="time" value="' + strings.time + '"/>\
					<input type="hidden" name="domain" value="' + strings.domain + '"/>\
					<br>\
					<p class="classyea-deactivate-dialog-buttons">\
						<input type="submit" class="button confirm" value="' + strings.skip_and_deactivate + '"/>\
						<button data-remodal-action="cancel" class="button button-primary">' + strings.cancel + '</button>\
					</p>\
				</form>\
			</div>\
		')[0];
		this.element = element;

		// console.log($(element).find("input[name='plugin']").val());

		// console.log(this.element);
		
		$(element).find("input[name='plugin']").val(JSON.stringify(plugin));
		
		$(element).on("click", "input[name='reason']", function(event) {

			$(element).find("input[type='submit']").val(
				strings.submit_and_deactivate
			);
		});
		
		$(element).find("form").on("submit", function(event) {
			self.onSubmit(event);
		});

		
		// Reasons list
		var ul = $(element).find("ul.classyea-deactivate-reasons");

		for(var key in plugin.reasons)
		{
			var li = $("<li><input type='radio' name='reason' id=" + key + " /> <label for=" + key + "></label></li>");

			//console.log(key);
			
			$(li).find("input").val(key);
			$(li).find("label").html(plugin.reasons[key]);
			
			$(ul).append(li);
		}
		
		// Listen for deactivate
		$("#the-list [data-slug='" + plugin.slug + "'] .deactivate>a").on("click", function(event) {
			self.onDeactivateClicked(event);
		});
	}
	
	DeactivateFeedbackForm.prototype.onDeactivateClicked = function(event)
	{
		this.deactivateURL = event.target.href;

		console.log(this.deactivateURL)
		
		event.preventDefault();
		
		if(!this.dialog)
			this.dialog = $(this.element).remodal();
		this.dialog.open();
	}
	
	DeactivateFeedbackForm.prototype.onSubmit = function(event)
	{
		var element = this.element;
		var strings = classyea_deactivate_feedback_form_strings;
		var self = this;
		
		var data = {};
		$.each($(element).find("form").serializeArray(), function(i, field) {
			data[field.name] = field.value;
		});
		$(element).find("button, input[type='submit']").prop("disabled", true);
		
		if($(element).find("input[name='reason']:checked").length)
		{
		
			$(element).find("input[type='submit']").val(strings.thank_you);

			$.ajax({
				type:		"POST",
				url:		"https://api.classyaddons.com/?uninstall_feedback",
				crossDomain: true,
				data:		data,
				success:	function($response) {
					window.location.href = self.deactivateURL;
				},
			});
		}
		else
		{

			$(element).find("input[type='submit']").val(strings.please_wait);
			window.location.href = self.deactivateURL;
		}
		
		event.preventDefault();
		return false;
	}
	
	$(document).ready(function() {
		
		for(var i = 0; i < classyea_deactivate_feedback_form_plugins.length; i++)
		{
			var plugin = classyea_deactivate_feedback_form_plugins[i];
			new DeactivateFeedbackForm(plugin);
		}
		
	});
	
})(jQuery);