
<script>
    const data = JSON.parse((document.querySelector('[type="json/data"]')).innerHTML);

    export default {
        render: (h) => {
            return (
                <table class="table table-striped table-bordered">
                    {Object.keys(data).map(performer => {
                        const rows = Object.values(data[performer]).map(task => {
                            const { title, labor = 0, non_labor = 0 } = task;
                            const sum = labor + non_labor;
                            return <tr><td>{title}</td><td>{labor}</td><td>{non_labor}</td><td>{sum}</td></tr>
                        });

                       return (
                           <tbody>
                                <tr>
                                   <td>{performer}</td>
                                   <td>Labor </td>
                                   <td>Non Labor</td>
                                   <td>Total</td>
                                </tr>
                                {rows}
                            </tbody>
                       )
                    })}
                </table>
            )
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>


