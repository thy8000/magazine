import { useQuery, gql } from "@apollo/client";

import { Meta, Header, CustomColors } from "../components/_index";

import { FrontPageQuery  } from "../queries/FrontPage";

export default function FrontPage() {
  const { data } = useQuery(FrontPageQuery);

  const siteGeneralSettings = data?.generalSettings ?? [];

  return (
    <div className="bg-page_color">
      <Meta
        title={siteGeneralSettings.title ?? ""}
        description={siteGeneralSettings.description ?? ""}
      />

      <CustomColors />

      <Header />

      <h1>Front Page</h1>
    </div>
  );
}
