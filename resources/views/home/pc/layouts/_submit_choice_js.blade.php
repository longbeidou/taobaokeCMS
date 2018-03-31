<script type="text/javascript">
	function submitChoice(value) {
		var form = $("#superSearchForm");

    // 站内搜索
		if (value == 1) {
			form.action = '{{ route('home.coupon.search') }}';
			$("#superSearchForm").attr('action', form.action);
			form.submit();
		}
    // 超级搜索 搜索淘宝服务器的优惠券
		if (value == 2) {
			form.action = "{{ route('home.superSearch.resultPC') }}";
			$("#superSearchForm").attr('action', form.action);
			form.submit();
		}
  }
</script>
