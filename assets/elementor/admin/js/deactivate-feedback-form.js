(function($) {


	if(!window.classyea)
		window.classyea = {};
	
	if(classyea.Classea_User_Feedback_Func)
		return;
	
	function Classea_User_Feedback_Func(pluginData)
	{
		var self = this;
		var data_strings = classyea_feedback_obj;
		
		this.pluginData = pluginData;
		
		// Dialog HTML
		var data_element = $('\
			<div class="deactivate-wrapper-area" data-remodal-id="' + pluginData.slug + '">\
				<form>\
					<input type="hidden" name="plugin"/>\
					<input type="hidden" id="_wpnonce" name="_wpnonce" value="' + data_strings.classy_uninstall_nonce + '">\
					<h2>' + data_strings.quick_feedback + '</h2>\
					<p>\
						' + data_strings.why_deactive_plugin + '\
					</p>\
					<ul class="classyea-deactivate-reasons"></ul>\
					<input name="comments" placeholder="' + data_strings.brief_description + '"/>\
					<input type="hidden" name="time" value="' + data_strings.time + '"/>\
					<input type="hidden" name="domain" value="' + data_strings.domain + '"/>\
					<br>\
					<p class="deactivate-wrapper-area-buttons">\
						<input type="submit" class="button confirm" value="' + data_strings.skip_and_deactivate + '"/>\
						<button data-remodal-action="cancel" class="button button-primary">' + data_strings.cancel + '</button>\
					</p>\
				</form>\
			</div>\
		')[0];
		this.data_element = data_element;
		
		$(data_element).find("input[name='plugin']").val(JSON.stringify(pluginData));
		
		$(data_element).on("click", "input[name='reason']", function(e) {

			$(data_element).find("input[type='submit']").val(
				data_strings.submit_and_deactivate
			);
		});
		
		$(data_element).find("form").on("submit", function(e) {
			self.onSubmit(e);
		});

		
		// Reasons list
		var ul = $(data_element).find("ul.classyea-deactivate-reasons");

		for(var singledata in pluginData.reasons)
		{
			var li = $("<li><input type='radio' name='reason' id=" + singledata + " /> <label for=" + singledata + "></label></li>");

			
			$(li).find("input").val(singledata);
			$(li).find("label").html(pluginData.reasons[singledata]);
			
			$(ul).append(li);
		}
		
		// Listen for deactivate
		$("#the-list [data-slug='" + pluginData.slug + "'] .deactivate>a").on("click", function(e) {
			self.onDeactivateClicked(e);
		});
	}
	
	
	Classea_User_Feedback_Func.prototype.onSubmit = function(e)
	{
		var data_element = this.data_element;
		var data_strings = classyea_feedback_obj;
		var self = this;
		
		var dataArray = {};
		$.each($(data_element).find("form").serializeArray(), function(i, field) {
			dataArray[field.name] = field.value;
		});
		$(data_element).find("button, input[type='submit']").prop("disabled", true);
		
		if($(data_element).find("input[name='reason']:checked").length)
		{
		
			$(data_element).find("input[type='submit']").val(data_strings.thank_you);

			$.ajax({
				type:		"POST",
				url:		"http://api.classyaddons.com//?uninstall_feedback",
				crossDomain: true,
				data:		dataArray,
				success:	function($data) {
					window.location.href = self.deactivateURL;
				},
			});
		}
		else
		{

			$(data_element).find("input[type='submit']").val(data_strings.please_wait);
			window.location.href = self.deactivateURL;
		}
		
		e.preventDefault();
		return false;
	}
	
	$(document).ready(function() {
		
		for(var i = 0; i < classyea_deactivate_feedback_form_filter.length; i++)
		{
			var plugindata = classyea_deactivate_feedback_form_filter[i];
			new Classea_User_Feedback_Func(plugindata);
		}
		
	});

	Classea_User_Feedback_Func.prototype.onDeactivateClicked = function(e)
	{
		this.deactivateURL = e.target.href;

		console.log(this.deactivateURL)
		
		e.preventDefault();
		
		if(!this.dialog)
			this.dialog = $(this.data_element).remodal();
		this.dialog.open();
	}
	
})(jQuery);