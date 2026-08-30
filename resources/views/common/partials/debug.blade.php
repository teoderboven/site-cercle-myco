<div style="background-color: red; color: black; opacity: 0.5; padding: 7px; border-radius: 7px; position:fixed; right: 15px; bottom: 15px; pointer-events:none; z-index:9999999999">
	<p style="font-weight: bold;text-align:center">Debug Mode</p>
	<p style="font-size: .7em">PHP Version: {{ phpversion() }}</p>
	<p style="font-size: .7em">Laravel Version: {{ app()->version() }}</p>
</div>