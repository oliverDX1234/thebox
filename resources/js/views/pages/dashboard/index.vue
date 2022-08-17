<script>
import Layout from "../../layouts/main";
import PageHeader from "@/components/custom/page-header";

import Stat from "./widget";
import RevenueAnalytics from "./revenue";
import SalesAnalytics from "./sales-analytics";
import EarningReport from "./earning";
import Sources from "./sources";
import RecentActivity from "./recent-activity";
import RevenueLocation from "./revenue-location";
import Chat from "./chat";
import Transaction from './transaction';

/**
 * Dashboard component
 */
export default {
    components: {
        Layout,
        PageHeader,
        Stat,
        RevenueAnalytics,
        SalesAnalytics,
        EarningReport,
        Sources,
        RecentActivity,
        RevenueLocation,
        Chat,
        Transaction
    },
    data() {
        return {
            title: "Dashboard",
            items: [
                {
                    text: "Nazox"
                },
                {
                    text: "Dashboard",
                    active: true
                }
            ]
        };
    }
};
</script>

<template>
    <Layout>
        <PageHeader :title="title" />
        <div className="row">
            <div className="col-xl-8">
                <Stat/>
                <RevenueAnalytics/>
            </div>
            <div className="col-xl-4">
                <SalesAnalytics/>
                <EarningReport/>
            </div>
        </div>
        <div className="row">
            <div className="col-lg-4">
                <Sources/>
            </div>
            <div className="col-lg-4">
                <RecentActivity/>
            </div>
            <div className="col-lg-4">
                <RevenueLocation/>
            </div>
        </div>
        <div className="row">
            <div className="col-lg-4">
                <Chat/>
            </div>
            <div className="col-lg-8">
                <Transaction/>
            </div>
        </div>
    </Layout>
</template>
