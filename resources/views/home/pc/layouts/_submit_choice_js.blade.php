<script type="text/javascript">
  function changeSubmit () {
		value = $('.searchSelect').val();

		// 全站搜素
		if (value == 'super') {
			$('.submit-button').attr('onclick', 'submitChoice(2)')
		}

		// 站内搜索
		if (value == 'inner') {
			$('.submit-button').attr('onclick', 'submitChoice(1)')
		}

    // 聚划算搜索
    if (value == 'ju') {
      $('.submit-button').attr('onclick', 'submitChoice(3)')
    }
	}

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
    // 搜索聚划算的优惠信息
    if (value == 3) {
      form.action = "{{ route('home.superSearch.resultJuPC') }}";
      $("#superSearchForm").attr('action', form.action);
      form.submit();
    }
  }
</script>
